<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    protected $with = ['book'];
    protected $guarded = [];
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
