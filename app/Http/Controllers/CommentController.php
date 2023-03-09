<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(){
        $args = request()->validate([
            'body' => 'required',
            'book_id' => 'required|integer',
        ]);
        $args['user_id'] = auth()->user()->id;
        Comment::create($args);
        return back()->with('commented','true');
    }
}
