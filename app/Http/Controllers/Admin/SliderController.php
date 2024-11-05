<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function index()
    {
        $sliderImages = Slider::all();
        return view('admin.sliders.index', compact('sliderImages'));
    }

    public function create()
    {
        $sliderImagesCount = Slider::count();

        if ($sliderImagesCount >= 2) {
            return redirect()->route('sliders.index')->with('error', 'Siz 2-dən daha çox slider rəsmi əlavə edə bilməzsiniz. Əgər yeni rəsim əlavə etmək istəyirsinizsə, öncəliklə var olan rəsimlərdən birini silməlisiniz.');
        }

        return view('admin.sliders.create');
    }

    public function store(SliderRequest $request)
    {
        $request->validated();
        $sliderImagesCount = Slider::count();

        if ($sliderImagesCount >= 2) {
            return redirect()->route('sliders.index')->with('error', 'Siz 2-dən daha çox slider rəsmi əlavə edə bilməzsiniz. Əgər yeni rəsim əlavə etmək istəyirsinizsə, öncəliklə var olan rəsimlərdən birini silməlisiniz.');
        }

        // Ensure the directory exists
        if (!Storage::exists('public/sliders')) {
            Storage::makeDirectory('public/sliders');
        }

        if ($request->hasFile('file')) {
            // Process and store the image as WebP with resizing
            $filePath = 'sliders/' . uniqid() . '.webp';
            $image = Image::make($request->file('file'))
                ->resize(1920, 1080) // Resize dimensions, adjust as needed
                ->encode('webp', 80); // Convert to WebP with 80% quality

            Storage::disk('public')->put($filePath, (string) $image);

            Slider::create([
                'file' => $filePath,
            ]);
        }

        return redirect()->route('sliders.index')->with('success', 'Slider rəsmi əlavə edildi.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'file' => 'nullable|image|max:2048',
        ]);

        // Ensure the directory exists
        if (!Storage::exists('public/sliders')) {
            Storage::makeDirectory('public/sliders');
        }

        if ($request->hasFile('file')) {
            // Delete old image if it exists
            if (Storage::disk('public')->exists($slider->file)) {
                Storage::disk('public')->delete($slider->file);
            }

            // Process and store the new image as WebP with resizing
            $filePath = 'sliders/' . uniqid() . '.webp';
            $newImage = Image::make($request->file('file'))
                ->resize(1920, 1080) // Resize dimensions, adjust as needed
                ->encode('webp', 80); // Convert to WebP with 80% quality

            Storage::disk('public')->put($filePath, (string) $newImage);

            $slider->update(['file' => $filePath]);
        }

        return redirect()->route('sliders.index')->with('success', 'Slider rəsmi güncəlləndi.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->file && Storage::disk('public')->exists(basename($slider->file))) {
            Storage::disk('public')->delete(basename($slider->file));
        }

        $slider->delete();

        return redirect()->route('sliders.index')->with('success', 'Slider rəsmi silindi.');
    }

    public function show(Slider $slider)
    {
        return view('admin.sliders.show', compact('slider'));
    }
}
