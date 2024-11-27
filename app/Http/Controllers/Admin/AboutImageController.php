<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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

        // Create the directory if it doesn't exist
        if (!Storage::exists('public/about_images')) {
            Storage::makeDirectory('public/about_images');
        }

        if ($request->hasFile('about_image')) {
            // Process and store the image as WebP with resizing
            $filePath = 'about_images/' . uniqid() . '.webp';
            $image = Image::make($request->file('about_image'))
                ->resize(800, 600) // Resize the image to 800x600
                ->encode('webp', 80); // Convert to WebP with 80% quality

            Storage::disk('public')->put($filePath, (string) $image);

            AboutImage::create([
                'about_image' => $filePath,
            ]);
        }

        return redirect()->route('about_images.index')->with('success', 'About image əlavə edildi.');
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

        // Create the directory if it doesn't exist
        if (!Storage::exists('public/about_images')) {
            Storage::makeDirectory('public/about_images');
        }

        if ($request->hasFile('about_image')) {
            // Delete old image if it exists
            if (Storage::disk('public')->exists($aboutImage->about_image)) {
                Storage::disk('public')->delete($aboutImage->about_image);
            }

            // Process and store the new image as WebP with resizing
            $filePath = 'about_images/' . uniqid() . '.webp';
            $image = Image::make($request->file('about_image'))
                ->resize(800, 600) // Resize to 800x600
                ->encode('webp', 80); // Convert to WebP with 80% quality

            Storage::disk('public')->put($filePath, (string) $image);

            $aboutImage->update(['about_image' => $filePath]);
        }

        return redirect()->route('about_images.index')->with('success', 'About image güncəlləndi.');
    }

    public function destroy(AboutImage $aboutImage)
    {
        if (Storage::disk('public')->exists($aboutImage->about_image)) {
            Storage::disk('public')->delete($aboutImage->about_image);
        }

        $aboutImage->delete();

        return redirect()->route('about_images.index')->with('success', 'About image silindi.');
    }

    public function show(AboutImage $aboutImage)
    {
        return view('admin.about_images.show', compact('aboutImage'));
    }
}
