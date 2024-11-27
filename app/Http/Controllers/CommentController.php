<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use App\Models\HeaderImage;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
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

        return redirect()->route('blog.show', $blog_id)->with('success', 'Şərhiniz başarıyla kaydedildi!');
    }


}
