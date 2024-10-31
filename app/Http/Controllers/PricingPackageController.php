<?php

namespace App\Http\Controllers;

use App\Models\PricingPackage;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PricingPackageController extends Controller
{
    public function index()
    {
        $packages = PricingPackage::all();
        return view('admin.pricing.index', compact('packages'));
    }

    public function FrontIndex()
    {
        $packages = PricingPackage::all();
        return view('front.services.prices', compact('packages'));
    }

    public function create()
    {
        $services = Service::all();
        return view('admin.pricing.create', compact('services'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name.*' => 'required|string',
            'price' => 'required|numeric',
            'services' => 'required|array',
            'services.*' => 'array', // Ensure each language has an array of services
        ]);

        // Create the package
        $package = PricingPackage::create([
            'price' => $request->price,
        ]);

        // Attach services for each language
        foreach ($request->services as $language => $serviceIds) {
            $package->services()->attach($serviceIds);
        }

        // Store translations
        foreach ($request->name as $locale => $name) {
            $translation = $package->translateOrNew($locale);
            $translation->name = $name;
            $translation->slug = Str::slug($name);
            $translation->save();
        }

        return redirect()->route('pricing.index')->with('success', 'Paket uğurla əlavə olundu.');
    }



    public function edit($id)
    {
        $package = PricingPackage::findOrFail($id);
        return view('admin.pricing.edit', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name.*' => 'required|string', // Validation for multilingual names
            'price' => 'required|numeric',
            'services.*' => 'exists:services,id', // Ensure each selected service ID exists
        ]);

        $package = PricingPackage::findOrFail($id);

        // Update price
        $package->update([
            'price' => $request->price,
        ]);

        // Update attached services
        $package->services()->sync($request->services);

        // Update translations
        foreach ($request->name as $locale => $name) {
            $package->translateOrNew($locale)->fill([
                'name' => $name,
                'slug' => Str::slug($name),
            ])->save();
        }

        return redirect()->route('pricing.index')->with('success', 'Paket uğurla yeniləndi.');
    }

}
