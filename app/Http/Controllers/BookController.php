<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
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
        $books = Book::with('tags')->filter(request(['tag', 'sort', 'search']));
        // $books = Book::whereHas('tags', function (Builder $query) use ($tag) {
        //     $query->where('tags.id', $tag);
        // })->paginate(16);
        if (request('sort')) {
            $books->orderByDesc('averagerating');
        } else {
            $books->orderByDesc('created_at');
        }
        return json_encode($books->paginate(16));
    }
    public function show(Book $book)
    {
        return view('books.show', [
            'book' => $book,
        ]);
    }
    public function create()
    {
        return view('books.create');
    }
    public function store(){
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:50000',
            'title' => 'required',
            'description' => 'required'
        ]);
        $userId = auth()->user()->id;
        $book = Book::factory()->create([
            'title' => request('title'),
            'description' => request('description'),
            'user_id' => $userId,
        ]);
        $imageName = null;
        if (request('image')) {
            $imageName = $book->id . '.' . request('image')->extension();
            request('image')->storeAs(
                'books',
                $imageName,
                'public'
            );
            $book->update([
                'cover' => $imageName,
            ]);
        }
        return redirect('/books/'.$book->id)->with('created',true);
    }
    public function destroy(Book $book){
        if($book->user_id != auth()->user()->id){
            return false;
        }
        $book->delete();
        return true;
    }
    public function edit(Book $book){
        return view('books.edit',[
            'book' => $book,
        ]);
    }
    public function update(Book $book){
        if($book->user_id != auth()->user()->id){
            abort(403);
        }

        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:50000',
            'title' => 'required',
            'description' => 'required'
        ]);
        $userId = auth()->user()->id;
        $book->update([
            'title' => request('title'),
            'description' => request('description'),
            'user_id' => $userId,
        ]);
        $imageName = null;
        if (request('image')) {
            $imageName = $book->id . '.' . request('image')->extension();
            request('image')->storeAs(
                'books',
                $imageName,
                'public'
            );
            $book->update([
                'cover' => $imageName,
            ]);
        }
        return redirect('/books/'.$book->id);
    }
    public function getTitles()
    {
        $books = Book::orderBy('title')->select('title', 'id')->get();
        return json_encode($books);
    }
}
