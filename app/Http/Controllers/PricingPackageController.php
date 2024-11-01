<?php

namespace App\Http\Controllers;

use App\Models\PricingPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Service;


class PricingPackageController extends Controller
{
    public function index()
    {
        $packages = PricingPackage::with('translations')->get();
        return view('admin.pricing.index', compact('packages'));
    }

    public function FrontIndex()
    {
        $packages = PricingPackage::with('services.translations')->get();
        return view('front.services.prices', compact('packages'));
    }

    public function create()
    {
        $services = Service::with('translations')->get(); // Get all services with translations
        return view('admin.pricing.create', compact('services'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'price' => 'required|numeric',
            'name.*' => 'required|string',
            'service_id.*' => 'required|exists:services,id', // Ensure selected service exists
        ]);

        $package = PricingPackage::create([
            'price' => $data['price'],
        ]);

        foreach (['az', 'ru', 'en'] as $locale) {
            $package->translateOrNew($locale)->name = $data['name'][$locale];
            $package->translateOrNew($locale)->slug = \Str::slug($data['name'][$locale]);

            // Get the selected service's translated title and save as `service_name`
            // If multiple services are selected, iterate through each
            if (isset($data['service_id'][$locale]) && is_array($data['service_id'][$locale])) {
                foreach ($data['service_id'][$locale] as $serviceId) {
                    $service = Service::find($serviceId);
                    $package->translateOrNew($locale)->service_name .= $service->translate($locale)->title . ', '; // Append each service name
                }
                // Trim the last comma and space
                $package->translateOrNew($locale)->service_name = rtrim($package->translateOrNew($locale)->service_name, ', ');
            }
        }

        $package->save();

        return redirect()->route('pricing.index')->with('success', 'Pricing Package created successfully.');
    }

    public function edit($id)
    {
        $package = PricingPackage::findOrFail($id);
        $services = Service::with('translations')->get();
        return view('admin.pricing.edit', compact('package', 'services'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'price' => 'required|numeric',
            'name.*' => 'required|string',
            'service_id.*' => 'required|exists:services,id',
        ]);

        $package = PricingPackage::findOrFail($id);

        $package->update([
            'price' => $data['price'],
        ]);

        foreach (['az', 'ru', 'en'] as $locale) {
            $package->translateOrNew($locale)->name = $data['name'][$locale];
            $package->translateOrNew($locale)->slug = \Str::slug($data['name'][$locale]);

            // Reset service_name for this locale before adding new services
            $package->translateOrNew($locale)->service_name = '';

            // Get the selected service's translated title and save as `service_name`
            if (isset($data['service_id'][$locale]) && is_array($data['service_id'][$locale])) {
                foreach ($data['service_id'][$locale] as $serviceId) {
                    $service = Service::find($serviceId);
                    $package->translateOrNew($locale)->service_name .= $service->translate($locale)->title . ', ';
                }
                // Trim the last comma and space
                $package->translateOrNew($locale)->service_name = rtrim($package->translateOrNew($locale)->service_name, ', ');
            }
        }

        $package->save();

        return redirect()->route('pricing.index')->with('success', 'Pricing Package updated successfully.');
    }


    public function destroy($id)
    {
        $package = PricingPackage::findOrFail($id);
        $package->delete();

        return redirect()->route('pricing.index')->with('success', 'Package deleted successfully');
    }

}
