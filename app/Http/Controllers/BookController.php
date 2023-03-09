<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class BookController extends Controller
{
    public function index()
    {
        // $posts = Post::whereHas('comments', function (Builder $query) {
        //     $query->where('content', 'like', 'code%');
        // })->get();
        $tag = request("tag");
        $books = Book::latest()->with('tags')->filter(request(['tag']))->paginate(16);
        // $books = Book::whereHas('tags', function (Builder $query) use ($tag) {
        //     $query->where('tags.id', $tag);
        // })->paginate(16);
        return json_encode($books);
    }
    public function show(Book $book)
    {
        return view('books.show', [
            'book' => $book,
        ]);
    }
}
