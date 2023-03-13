<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store()
    {
        $args = request()->validate([
            'body' => 'required',
            'book_id' => 'required|integer',
        ]);
        $args['user_id'] = auth()->user()->id;
        Comment::create($args);
        return back()->with('commented', true);
    }
    public function destroy(Comment $comment)
    {
        if ($comment->user_id != auth()->user()->id) {
            abort(403);
        }
        $comment->delete();
        return back()->with('commented', true);
    }
}
