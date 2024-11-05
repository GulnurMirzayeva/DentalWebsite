<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeaderImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class HeaderImageController extends Controller
{
    public function index()
    {
        $headerImages = HeaderImage::all();
        return view('admin.header_images.index', compact('headerImages'));
    }

    public function create()
    {
        return view('admin.header_images.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'header_image' => 'required|image|max:2048',
        ]);

        // Ensure the directory exists
        if (!Storage::exists('public/header_images')) {
            Storage::makeDirectory('public/header_images');
        }

        if ($request->hasFile('header_image')) {
            // Process and store the image as WebP with resizing
            $filePath = 'header_images/' . uniqid() . '.webp';
            $image = Image::make($request->file('header_image'))
                ->resize(1600, 400) // Adjust dimensions as needed
                ->encode('webp', 80); // Convert to WebP with 80% quality

            Storage::disk('public')->put($filePath, (string) $image);

            // Save image path to the database
            HeaderImage::create([
                'header_image' => Storage::url($filePath),
            ]);
        }

        return redirect()->route('header_images.index')->with('success', 'Header image yükləndi.');
    }

    public function edit(HeaderImage $headerImage)
    {
        return view('admin.header_images.edit', compact('headerImage'));
    }

    public function update(Request $request, HeaderImage $headerImage)
    {
        $request->validate([
            'header_image' => 'nullable|image|max:2048',
        ]);

        // Ensure the directory exists
        if (!Storage::exists('public/header_images')) {
            Storage::makeDirectory('public/header_images');
        }

        if ($request->hasFile('header_image')) {
            // Delete old image if it exists
            if (Storage::disk('public')->exists(basename($headerImage->header_image))) {
                Storage::disk('public')->delete(basename($headerImage->header_image));
            }

            // Process and store the new image as WebP with resizing
            $filePath = 'header_images/' . uniqid() . '.webp';
            $newImage = Image::make($request->file('header_image'))
                ->resize(1600, 400) // Adjust dimensions as needed
                ->encode('webp', 80); // Convert to WebP with 80% quality

            Storage::disk('public')->put($filePath, (string) $newImage);

            // Update the image path in the database
            $headerImage->update(['header_image' => Storage::url($filePath)]);
        }

        return redirect()->route('header_images.index')->with('success', 'Header image güncəlləndi.');
    }

    public function destroy(HeaderImage $headerImage)
    {
        if (Storage::disk('public')->exists(basename($headerImage->header_image))) {
            Storage::disk('public')->delete(basename($headerImage->header_image));
        }

        $headerImage->delete();

        return redirect()->route('header_images.index')->with('success', 'Header image silindi.');
    }

    public function show(HeaderImage $headerImage)
    {
        return view('admin.header_images.show', compact('headerImage'));
    }
}
