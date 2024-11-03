<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        $service = new Service([
            'icon' => $request->file('icon')->store('services', 'public'),
        ]);
        $service->save();

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

        if ($request->hasFile('icon')) {
            $service->icon = $request->file('icon')->store('services', 'public');
        }

        $service->save();

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
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Xidmət silindi.');
    }
}
