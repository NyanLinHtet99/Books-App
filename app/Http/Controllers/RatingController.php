<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use Termwind\Components\Raw;

class RatingController extends Controller
{
    public function show(){
        $query = Rating::where('book_id',request('book_id'));
        $count = $query->count();
        $sum = $query->sum('value');
        $avg = ceil($sum/$count);
        $data =[
            'avg_rating'=>$avg,
        ];
        return json_encode($data);
    }
}
