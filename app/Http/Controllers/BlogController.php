<?php

namespace App\Http\Controllers;

use App\Models\BlogTranslation;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\HeaderImage;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(6);
        $defaultImage = asset('assets/front/img/bg_1.jpg');
        $headerImage = HeaderImage::latest()->first();
        $backgroundImage = $headerImage && Storage::disk('public')->exists($headerImage->header_image)
            ? asset('storage/' . $headerImage->header_image)
            : $defaultImage;
        return view('front.blog', compact('blogs', 'backgroundImage'));
    }

    public function store(Request $request, $blog_id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required',
        ]);


        BlogComment::create([
            'blog_id' => $blog_id,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
        ]);


        return back()->with('success', 'Şərhiniz başarıyla kaydedildi!');
    }


    public function show($slug)
    {
        $blogTranslation = BlogTranslation::where('slug', $slug)->firstOrFail();
        $blog = $blogTranslation->blog;
        $blog_comments = $blog->blog_comments;
        $blogs = Blog::withCount('blog_comments')->paginate(10);
        $recentBlogs = Blog::orderBy('created_at', 'desc')->take(5)->get();
        $defaultImage = asset('assets/front/img/bg_1.jpg');
        $headerImage = HeaderImage::latest()->first();
        $backgroundImage = $headerImage && Storage::disk('public')->exists($headerImage->header_image)
            ? asset('storage/' . $headerImage->header_image)
            : $defaultImage;


        return view('front.readmore', compact('blog', 'blogs','blog_comments', 'recentBlogs', 'backgroundImage'));
    }

}
