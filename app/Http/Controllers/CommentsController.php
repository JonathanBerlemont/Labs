<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Blog;

class CommentsController extends Controller
{
    public function store(Blog $blog)
    {
        request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required|min:5'
        ]);

        Comment::create([
            'name' => request('name'),
            'email' => request('email'),
            'subject' => request('subject'),
            'message' => request('message'),
            'blog_id' => $blog->id,
        ]);

        return redirect($blog->path());
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);

        $comment->delete();

        return back();
    }
}
