<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class AdminBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(6);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title.*' => 'required|string',
            'description_one.*' => 'nullable|string',
            'description_two.*' => 'nullable|string',
            'date' => 'required|date',
            'image_one' => 'nullable|image',
            'image_two' => 'nullable|image',
        ]);

        $blog = new Blog([
            'image_one' => $request->hasFile('image_one') ? $request->file('image_one')->store('blogs', 'public') : null,
            'image_two' => $request->hasFile('image_two') ? $request->file('image_two')->store('blogs', 'public') : null,
            'date' => $request->date,
        ]);
        $blog->save();

        foreach ($request->title as $locale => $title) {
            $blog->translateOrNew($locale)->title = $title;
            $blog->translateOrNew($locale)->slug = Str::slug($title);
            $blog->translateOrNew($locale)->description_one = $request->input("description_one.$locale");
            $blog->translateOrNew($locale)->description_two = $request->input("description_two.$locale");
        }
        $blog->save();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog əlavə edildi.');
    }


    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title.*' => 'required|string',
            'description_one.*' => 'nullable|string',
            'description_two.*' => 'nullable|string',
            'date' => 'required|date',
            'image_one' => 'nullable|image',
            'image_two' => 'nullable|image',
        ]);

        if ($request->hasFile('image_one')) {
            $blog->image_one = $request->file('image_one')->store('blogs', 'public');
        }
        if ($request->hasFile('image_two')) {
            $blog->image_two = $request->file('image_two')->store('blogs', 'public');
        }

        $blog->date = $request->date;
        $blog->save();

        // Çevirileri güncelle
        foreach ($request->title as $locale => $title) {
            $blog->translateOrNew($locale)->title = $title;
            $blog->translateOrNew($locale)->slug = Str::slug($title);
            $blog->translateOrNew($locale)->description_one = $request->input("description_one.$locale");
            $blog->translateOrNew($locale)->description_two = $request->input("description_two.$locale");
        }
        $blog->save();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog güncəlləndi.');
    }


    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog silindi.');
    }
}
