<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|image|max:2048',
            'title.*' => 'required|string|max:255',
            'description.*' => 'nullable|string',
        ]);

        // Ensure the directory exists
        if (!Storage::exists('public/services')) {
            Storage::makeDirectory('public/services');
        }

        $iconPath = null;
        if ($request->hasFile('icon')) {
            // Process and store the icon as WebP with resizing
            $iconPath = 'services/' . uniqid() . '.webp';
            $iconImage = Image::make($request->file('icon'))
                ->resize(100, 100) // Adjust icon dimensions as needed
                ->encode('webp', 80); // Convert to WebP with 80% quality

            Storage::disk('public')->put($iconPath, (string) $iconImage);
        }

        // Create new service with icon path
        $service = new Service(['icon' => $iconPath]);
        $service->save();

        // Handle translations
        foreach ($request->title as $locale => $title) {
            $translation = $service->translateOrNew($locale);
            $translation->title = $title;
            $translation->slug = Str::slug($title);
            $translation->description = $request->input("description.$locale");
            $translation->save();
        }

        return redirect()->route('admin.services.index')->with('success', 'Xidmət əlavə edildi.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'icon' => 'nullable|image|max:2048',
            'title.*' => 'required|string|max:255',
            'description.*' => 'nullable|string',
        ]);

        // Ensure the directory exists
        if (!Storage::exists('public/services')) {
            Storage::makeDirectory('public/services');
        }

        if ($request->hasFile('icon')) {
            // Delete old icon if it exists
            if ($service->icon && Storage::disk('public')->exists($service->icon)) {
                Storage::disk('public')->delete($service->icon);
            }

            // Process and store the new icon as WebP with resizing
            $iconPath = 'services/' . uniqid() . '.webp';
            $iconImage = Image::make($request->file('icon'))
                ->resize(100, 100) // Adjust icon dimensions as needed
                ->encode('webp', 80); // Convert to WebP with 80% quality

            Storage::disk('public')->put($iconPath, (string) $iconImage);
            $service->icon = $iconPath;
        }

        $service->save();

        // Handle translations
        foreach ($request->title as $locale => $title) {
            $translation = $service->translateOrNew($locale);
            $translation->title = $title;
            $translation->slug = Str::slug($title);
            $translation->description = $request->input("description.$locale");
            $translation->save();
        }

        return redirect()->route('admin.services.index')->with('success', 'Xidmət güncəlləndi.');
    }

    public function destroy(Service $service)
    {
        // Delete the icon from storage
        if ($service->icon && Storage::disk('public')->exists($service->icon)) {
            Storage::disk('public')->delete($service->icon);
        }

        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Xidmət silindi.');
    }
}
