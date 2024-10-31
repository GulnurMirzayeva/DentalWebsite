<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutImageController extends Controller
{
    public function index()
    {
        $aboutImages = AboutImage::all();
        return view('admin.about_images.index', compact('aboutImages'));
    }

    public function create()
    {
        return view('admin.about_images.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'about_image' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('about_image')) {
            $fileName = $request->file('about_image')->store('about_images', 'public');

            AboutImage::create([
                'about_image' => $fileName,
            ]);
        }

        return redirect()->route('about_images.index')->with('success', 'About image uploaded successfully');
    }

    public function edit(AboutImage $aboutImage)
    {
        return view('admin.about_images.edit', compact('aboutImage'));
    }

    public function update(Request $request, AboutImage $aboutImage)
    {
        $request->validate([
            'about_image' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('about_image')) {
            if (Storage::disk('public')->exists($aboutImage->about_image)) {
                Storage::disk('public')->delete($aboutImage->about_image);
            }

            $fileName = $request->file('about_image')->store('about_images', 'public');

            $aboutImage->update(['about_image' => $fileName]);
        }

        return redirect()->route('about_images.index')->with('success', 'About image updated successfully');
    }

    public function destroy(AboutImage $aboutImage)
    {
        if (Storage::disk('public')->exists($aboutImage->about_image)) {
            Storage::disk('public')->delete($aboutImage->about_image);
        }

        $aboutImage->delete();

        return redirect()->route('about_images.index')->with('success', 'About image deleted successfully');
    }

    public function show(AboutImage $aboutImage)
    {
        return view('admin.about_images.show', compact('aboutImage'));
    }
}
