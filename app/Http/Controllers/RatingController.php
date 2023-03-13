<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Rating;
use Termwind\Components\Raw;

class RatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show()
    {
        $query = Rating::where('book_id', request('book_id'));
        $avg = 0;
        $count = $query->count();
        if ($count > 0) {
            $sum = $query->sum('value');
            $avg = ceil($sum / $count);
        }
        $user_rating = $query->where('user_id', auth()->user()->id)->first();
        $data = [
            'avg_rating' => $avg,
            'user_rating' => $user_rating ? $user_rating->value : 0,
        ];
        return json_encode($data);
    }
    public function store()
    {
        $arrgs = request()->validate([
            'value' => 'required|integer',
            'book_id' => 'required',
        ]);
        $rating = Rating::firstOrNew([
            'book_id' => request('book_id'),
            'user_id' => auth()->user()->id,
        ]);
        $rating->value = request('value');
        $rating->save();
        return $this->show();
    }
}
