<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    public function create()
    {
        return view('admin.pages.gallery.create');
    }

    public function index()
    {
        $images = Gallery::orderBy('id', 'desc')->get();
        return view('admin.pages.gallery.index', compact('images'));
    }

    public function edit($id)
    {
        $image = Gallery::findOrFail($id);
        return view('admin.pages.gallery.edit', compact('image'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'alt_text' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Ensure the directory exists
        if (!Storage::exists('public/gallery')) {
            Storage::makeDirectory('public/gallery');
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Process and store the image as WebP with resizing
            $filePath = 'gallery/' . uniqid() . '.webp';
            $image = Image::make($request->file('image'))
                ->resize(800, 600) // Resize to 800x600 pixels
                ->encode('webp', 80); // Convert to WebP with 80% quality

            Storage::disk('public')->put($filePath, (string) $image);

            // Save the image path to the database
            Gallery::create([
                'image' => Storage::url($filePath),
                'alt_text' => $request->input('alt_text'),
                'description' => $request->input('description'),
            ]);

            return redirect()->back()->with('success', 'Şəkil əlavə edildi!');
        }

        return back()->withErrors('Etibarsız şəkil yüklənməsi. Zəhmət olmasa şəklin etibarlı olduğuna diqqət edin.');
    }

    public function update(Request $request, $id)
    {
        $image = Gallery::findOrFail($id);

        // Ensure the directory exists
        if (!Storage::exists('public/gallery')) {
            Storage::makeDirectory('public/gallery');
        }

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($image->image && Storage::disk('public')->exists(basename($image->image))) {
                Storage::disk('public')->delete(basename($image->image));
            }

            // Process and store the new image as WebP with resizing
            $filePath = 'gallery/' . uniqid() . '.webp';
            $newImage = Image::make($request->file('image'))
                ->resize(800, 600) // Resize to 800x600 pixels
                ->encode('webp', 80); // Convert to WebP with 80% quality

            Storage::disk('public')->put($filePath, (string) $newImage);

            // Update the image path in the database
            $image->image = Storage::url($filePath);
        }

        $image->alt_text = $request->input('alt_text');
        $image->description = $request->input('description');
        $image->save();

        return redirect()->route('admin.gallery.index')->with('success', 'Qaleriya güncəlləndi.');
    }

    public function destroy($id)
    {
        $images = Gallery::findOrFail($id);

        if ($images->image && Storage::exists(basename($images->image))) {
            Storage::disk('public')->delete(basename($images->image));
        }

        $images->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Şəkil silindi.');
    }
}
