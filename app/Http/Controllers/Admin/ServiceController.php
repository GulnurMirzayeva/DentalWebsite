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
        // Verilerin doğrulanması
        $request->validate([
            'icon' => 'required|image|max:2048', // İkon alanı için gereklilik
            'title.*' => 'required|string|max:255', // Tüm diller için başlık
            'description.*' => 'nullable|string', // Tüm diller için açıklama
        ]);

        // Yeni bir Service nesnesi oluştur
        $service = new Service([
            'icon' => $request->file('icon')->store('services', 'public'), // İkon dosyası
        ]);
        $service->save();

        // Çeviriler için döngü
        foreach ($request->title as $locale => $title) {
            $translation = $service->translateOrNew($locale);
            $translation->title = $title;
            $translation->slug = Str::slug($title); // Başlıktan slug oluşturma
            $translation->description = $request->input("description.$locale"); // Açıklama
            $translation->save();
        }

        return redirect()->route('admin.services.index')->with('success', 'Hizmet başarıyla eklendi.');
    }


    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        // Verilerin doğrulanması
        $request->validate([
            'icon' => 'nullable|image|max:2048', // İkon alanı isteğe bağlı
            'title.*' => 'required|string|max:255', // Tüm diller için başlık
            'description.*' => 'nullable|string', // Tüm diller için açıklama
        ]);

        // Resim güncelleme
        if ($request->hasFile('icon')) {
            $service->icon = $request->file('icon')->store('services', 'public'); // Yeni ikon yükle
        }

        $service->save(); // Diğer alanlar için kaydetme

        // Çevirileri güncelle
        foreach ($request->title as $locale => $title) {
            $translation = $service->translateOrNew($locale);
            $translation->title = $title;
            $translation->slug = Str::slug($title); // Başlıktan slug oluşturma
            $translation->description = $request->input("description.$locale"); // Açıklama
            $translation->save();
        }

        return redirect()->route('admin.services.index')->with('success', 'Hizmet başarıyla güncellendi.');
    }


    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Xidmət uğurla silindi.');
    }
}
