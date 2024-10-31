<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeaderImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        if ($request->hasFile('header_image')) {
            $fileName = $request->file('header_image')->store('header_images', 'public');

            HeaderImage::create([
                'header_image' => $fileName,
            ]);
        }

        return redirect()->route('header_images.index')->with('success', 'Header image uploaded successfully');
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

        if ($request->hasFile('header_image')) {
            if (Storage::disk('public')->exists($headerImage->header_image)) {
                Storage::disk('public')->delete($headerImage->header_image);
            }

            $fileName = $request->file('header_image')->store('header_images', 'public');

            $headerImage->update(['header_image' => $fileName]);
        }

        return redirect()->route('header_images.index')->with('success', 'Header image updated successfully');
    }

    public function destroy(HeaderImage $headerImage)
    {
        if (Storage::disk('public')->exists($headerImage->header_image)) {
            Storage::disk('public')->delete($headerImage->header_image);
        }

        $headerImage->delete();

        return redirect()->route('header_images.index')->with('success', 'Header image deleted successfully');
    }

    public function show(HeaderImage $headerImage)
    {
        return view('admin.header_images.show', compact('headerImage'));
    }
}
