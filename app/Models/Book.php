<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use function PHPSTORM_META\type;

class Book extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->orderByDesc('created_at');
    }
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class)->orderByDesc('number');
    }
    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['search'] ?? false, function ($query, $search) {
            $query
                ->where(
                    fn ($query) =>
                    $query->where('title', 'LIKE', '%' . strtolower($search) . '%')
                        ->orWhere('description', 'LIKE', '%' . strtolower($search) . '%')
                );
        });
        $query->when($filter['user'] ?? false, function ($query, $user) {
            $query
                ->where(
                    'books.user_id',
                    $user
                );
        });
        $query->when($filter['tags'] ?? false, function ($query, $tags) {
            foreach ($tags as $tag) {
                $query
                    ->whereHas('tags', function (Builder $query) use ($tag) {
                        $query->where('tags.id', $tag);
                    });
            }
        });
        $query->when($filter['sort'] ?? false, function ($query) {

            $query
                ->select(
                    'books.*',
                    DB::raw('AVG(ratings.value) as averagerating')
                )
                ->leftJoin('ratings', 'ratings.book_id', 'books.id')
                ->groupBy('books.id');
        });

        // ->whereHas('ratings', function (Builder $query) {
        //     $query->select('books.*', DB::raw('AVG(ratings.value) as avg'))
        //         ->groupBy('ratings.book_id')->orderBy('avg');
        // })
    }
}
