<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    // eager loading relationships on models or queries
    protected $with = ['category', 'author'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    // scopeSearchFilter is a query scope that can be used to filter the posts by title or body
    // the scopeSearchFilter is called in the PostsController, scope is a prefix translated automatically by laravel
    public function scopeSearchFilter($query, array $filters)
    {
        // first search for the title or body of the post and then search for the rest
        $query->when($filters['search'] ?? false,
            fn($query, $search) => $query->where(fn($query) => $query->where('title', 'like', '%'.$search.'%')
                ->orWhere('body', 'like', '%'.$search.'%')));

        $query->when($filters['category'] ?? false, fn($query, $category) => $query
            ->whereHas('category', fn($query) => $query
                ->where('slug', $category)));

        $query->when($filters['author'] ?? false, fn($query, $author) => $query
            ->whereHas('author', fn($query) => $query
                ->where('username', $author)));
    }
}
