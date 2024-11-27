<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    public function index(Request $request)
    {
        $comments = BlogComment::orderBy('created_at', 'desc')->get();

        return view('admin.comments.index', compact('comments'));
    }

    public function destroy($id)
    {
        $comment = BlogComment::findOrFail($id);
        $comment->delete();

        return redirect()->route('admin.comments.index')->with('success', 'Şərh silindi.');
    }
}
