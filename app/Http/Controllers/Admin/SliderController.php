<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $filePath = $request->file('file')->store('sliders', 'public');

        Slider::create([
            'file' => $filePath,
        ]);

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

        if ($request->hasFile('file')) {
            if (Storage::disk('public')->exists($slider->file)) {
                Storage::disk('public')->delete($slider->file);
            }
            $filePath = $request->file('file')->store('sliders', 'public');
            $slider->update(['file' => $filePath]);
        }

        return redirect()->route('sliders.index')->with('success', 'Slider rəsmi güncəlləndi.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->file && Storage::disk('public')->exists($slider->file)) {
            Storage::disk('public')->delete($slider->file);
        }

        $slider->delete();

        return redirect()->route('sliders.index')->with('success', 'Slider rəsmi silindi.');
    }


    public function show(Slider $slider)
    {
        return view('admin.sliders.show', compact('slider'));
    }
}
