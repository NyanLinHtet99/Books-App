<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
    public function comments(): HasMany{
        return $this->hasMany(Comment::class);
    }
    public function ratings(): HasMany{
        return $this->hasMany(Rating::class);
    }
    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['tag'] ?? false, function ($query, $tag) {
            $query
                ->whereHas('tags', function (Builder $query) use ($tag) {
                    $query->where('tags.id', $tag);
                });
        });
    }
}
