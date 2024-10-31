<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('images', $filename, 'public');

            Gallery::create([
                'image' => Storage::url($path),
                'alt_text' => $request->input('alt_text'),
                'description' => $request->input('description'),
            ]);

            return redirect()->back()->with('success', 'Image uploaded successfully!');
        }

        return back()->withErrors('Invalid image upload. Please ensure a valid image is provided.');
    }


    public function update(Request $request, $id)
    {
        $image = Gallery::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($image->image && Storage::disk('public')->exists(basename($image->image))) {
                Storage::disk('public')->delete(basename($image->image));
            }

            $path = $request->file('image')->store('gallery', 'public');
            $image->image = 'storage/' . $path;
        }

        $image->alt_text = $request->input('alt_text');
        $image->description = $request->input('description');
        $image->save();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery updated successfully.');
    }


    public function destroy($id)
    {
        $images = Gallery::findOrFail($id);

        if ($images->image && Storage::exists($images->image)) {
            Storage::delete($images->image);
        }

        $images->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Image deleted successfully.');
    }
}
