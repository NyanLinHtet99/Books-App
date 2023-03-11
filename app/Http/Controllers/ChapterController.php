<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function show(Chapter $chapter)
    {
        $number = $chapter->number;
        $nextChapter = Chapter::where('book_id', $chapter->book->id)->where('number', $number + 1)->first();
        $prevChapter = Chapter::where('book_id', $chapter->book->id)->where('number', $number - 1)->first();
        return view('chapters.show', [
            'chapter' => $chapter,
            'nextChapter' => $nextChapter,
            'prevChapter' => $prevChapter
        ]);
    }
    public function create(Book $book){
        return view('chapters.create',
            [
                'book' => $book,
            ]
            );
    }
    public function store(Book $book){
        request()->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $book->chapters()->create([
            'title' => request('title'),
            'body' => request('body'),
            'number' => $book->chapters->count() + 1,
        ]);
        return redirect('/books/'.$book->id);
    }
}
