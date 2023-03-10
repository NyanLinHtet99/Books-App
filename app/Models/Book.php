<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->orderByDesc('created_at');
    }
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['tag'] ?? false, function ($query, $tag) {
            $query
                ->whereHas('tags', function (Builder $query) use ($tag) {
                    $query->where('tags.id', $tag)->orderByDesc('created_at');
                });
        });
        $query->when($filter['sort'] ?? false, function ($query, $sort) {
            if ($sort === 'avg') {
                $query
                    ->select(
                        'books.*',
                        DB::raw('AVG(ratings.value) as averagerating')
                    )
                    ->leftJoin('ratings', 'ratings.book_id', 'books.id')
                    ->orderByDesc('averagerating')
                    ->groupBy('books.id');
            } elseif ($sort === 'time') {
                $query->latest();
            }
        });
        // ->whereHas('ratings', function (Builder $query) {
        //     $query->select('books.*', DB::raw('AVG(ratings.value) as avg'))
        //         ->groupBy('ratings.book_id')->orderBy('avg');
        // })
    }
}
