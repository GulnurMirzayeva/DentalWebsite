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

        // If specific comment_id is provided, scroll to that comment
        $highlightedCommentId = $request->query('comment_id');

        return view('admin.comments.index', compact('comments', 'highlightedCommentId'));
    }

    public function destroy($id)
    {
        $comment = BlogComment::findOrFail($id);
        $comment->delete();

        return redirect()->route('admin.comments.index')->with('success', 'Şərh silindi.');
    }

    public function markAsRead()
    {
        BlogComment::where('is_read', false)->update(['is_read' => true]);

        // Return the updated count to confirm the front end
        return response()->json(['success' => true, 'unread_count' => 0]);
    }
}
