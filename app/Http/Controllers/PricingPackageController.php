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
        $services = Service::with('translations')->get();
        return view('admin.pricing.create', compact('services'));
    }


    public function store(Request $request)
    {

        // PricingPackage cədvəlində mövcud paketlərin sayını yoxlayırıq
        $existingPackageCount = PricingPackage::count();

        // Əgər 4-dən çox paket varsa, xəbərdarlıq mesajı göndəririk
        if ($existingPackageCount >= 4) {
            return redirect()->route('pricing.index')->with('error', 'Yalnız 4 qiymət paketi yarada bilərsiniz.');
        }

        $data = $request->validate([
            'price' => 'required|numeric',
            'name.*' => 'required|string',
            'service_id.*' => 'required|exists:services,id',
        ]);

        $package = PricingPackage::create([
            'price' => $data['price'],
        ]);

        foreach (['az', 'ru', 'en'] as $locale) {
            $package->translateOrNew($locale)->name = $data['name'][$locale];
            $package->translateOrNew($locale)->slug = \Str::slug($data['name'][$locale]);


            if (isset($data['service_id'][$locale]) && is_array($data['service_id'][$locale])) {
                foreach ($data['service_id'][$locale] as $serviceId) {
                    $service = Service::find($serviceId);
                    $package->translateOrNew($locale)->service_name .= $service->translate($locale)->title . ', ';
                }
                $package->translateOrNew($locale)->service_name = rtrim($package->translateOrNew($locale)->service_name, ', ');
            }
        }

        $package->save();

        return redirect()->route('pricing.index')->with('success', 'Qiymət paketi yaradıldı.');
    }

    public function edit($id)
    {
        $package = PricingPackage::with(['services', 'translations'])->findOrFail($id);
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

        // Attach services
        $serviceIds = array_merge(...array_values($data['service_id'])); // Flattening the array
        $package->services()->sync($serviceIds); // Use sync to update pivot table

        foreach (['az', 'ru', 'en'] as $locale) {
            $package->translateOrNew($locale)->name = $data['name'][$locale];
            $package->translateOrNew($locale)->slug = \Str::slug($data['name'][$locale]);
            $package->translateOrNew($locale)->service_name = '';

            if (isset($data['service_id'][$locale]) && is_array($data['service_id'][$locale])) {
                foreach ($data['service_id'][$locale] as $serviceId) {
                    $service = Service::find($serviceId);
                    $package->translateOrNew($locale)->service_name .= $service->translate($locale)->title . ', ';
                }
                $package->translateOrNew($locale)->service_name = rtrim($package->translateOrNew($locale)->service_name, ', ');
            }
        }

        $package->save();

        return redirect()->route('pricing.index')->with('success', 'Qiymət paketi güncəlləndi.');
    }

    public function destroy($id)
    {
        $package = PricingPackage::findOrFail($id);
        $package->delete();

        return redirect()->route('pricing.index')->with('success', 'Qiymət paketi silindi.');
    }

}
