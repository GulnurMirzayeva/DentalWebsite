<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

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

        // Create the directory if it doesn't exist
        if (!Storage::exists('public/blogs')) {
            Storage::makeDirectory('public/blogs');
        }

        // Process image_one
        if ($request->hasFile('image_one')) {
            $imageOne = $request->file('image_one');
            $imageOnePath = 'blogs/' . Str::random(10) . '.webp';
            Image::make($imageOne)
                ->resize(800, 600)
                ->encode('webp', 80)
                ->save(storage_path("app/public/{$imageOnePath}"));
        }

        // Process image_two
        if ($request->hasFile('image_two')) {
            $imageTwo = $request->file('image_two');
            $imageTwoPath = 'blogs/' . Str::random(10) . '.webp';
            Image::make($imageTwo)
                ->resize(800, 600)
                ->encode('webp', 80)
                ->save(storage_path("app/public/{$imageTwoPath}"));
        }

        $blog = new Blog([
            'image_one' => $imageOnePath ?? null,
            'image_two' => $imageTwoPath ?? null,
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

        // Process image_one
        if ($request->hasFile('image_one')) {
            $imageOne = $request->file('image_one');
            $imageOnePath = 'blogs/' . Str::random(10) . '.webp';
            Image::make($imageOne)
                ->resize(800, 600)
                ->encode('webp', 80)
                ->save(storage_path("app/public/{$imageOnePath}"));
            $blog->image_one = $imageOnePath;
        }

        // Process image_two
        if ($request->hasFile('image_two')) {
            $imageTwo = $request->file('image_two');
            $imageTwoPath = 'blogs/' . Str::random(10) . '.webp';
            Image::make($imageTwo)
                ->resize(800, 600)
                ->encode('webp', 80)
                ->save(storage_path("app/public/{$imageTwoPath}"));
            $blog->image_two = $imageTwoPath;
        }

        $blog->date = $request->date;
        $blog->save();

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
