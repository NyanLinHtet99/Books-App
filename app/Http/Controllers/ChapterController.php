<?php

namespace App\Http\Controllers;

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
}
