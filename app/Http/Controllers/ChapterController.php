<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
    public function create(Book $book)
    {
        return view(
            'chapters.create',
            [
                'book' => $book,
            ]
        );
    }
    public function store(Book $book)
    {
        request()->validate([
            'title' => 'required',
            'body' => 'required',
            'number' => 'required'
        ]);
        $chapterExist = Chapter::where('book_id', $book->id)->where('number', request('number'))->first();
        if ($chapterExist) {
            $chapterExist->update([
                'title' => request('title'),
                'body' => request('body'),
            ]);
        } else {
            $book->chapters()->create([
                'title' => request('title'),
                'body' => request('body'),
                'number' => request('number'),
            ]);
        }
        return redirect('/books/' . $book->id);
    }
    public function destroy(Chapter $chapter)
    {
        if ($chapter->book->user_id != auth()->user()->id) {
            abort(403);
        }
        $chapter->delete();
        return back();
    }
    public function edit(Chapter $chapter)
    {
        return view('chapters.edit', [
            'chapter' => $chapter
        ]);
    }
    public function update(Chapter $chapter)
    {
        if ($chapter->book->user_id != auth()->user()->id) {
            abort(403);
        }
        $args = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'number' => 'required'
        ]);
        $chapterWithNumber = Chapter::where('book_id', $chapter->book_id)->where('number', request('number'))->first();
        if ($chapterWithNumber) {
            $chapter->delete();
            $chapterWithNumber->update($args);
            return $this->show($chapterWithNumber);
        } else {
            $chapter->update($args);
            return $this->show($chapter);
        }
    }
}
