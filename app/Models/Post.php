<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    // scopeSearchFilter is a query scope that can be used to filter the posts by title or body
    // the scopeSearchFilter is called in the PostsController, scope is a prefix translated automatically by laravel
    public function scopeSearchFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) => $query
            ->where('title', 'like', '%'.$search.'%')
            ->orWhere('body', 'like', '%'.$search.'%'));

        // the query will search the category table for the slug column that matches the category filter
        $query->when($filters['category'] ?? false, fn($query, $category) => $query
            ->whereHas('category', fn($query) => $query
                ->where('slug', $category)));

        $query->when($filters['author'] ?? false, fn($query, $author) => $query
            ->whereHas('author', fn($query) => $query
                ->where('username', $author)));
    }

    public function scopeSearchFilter2($query, array $filters)
    {
        $query->when($filters['search'] ?? false,
            fn($query, $search) => $query->where(fn($query) => $query->where('title', 'like', '%'.$search.'%')
                ->orWhere('body', 'like', '%'.$search.'%')));

        // the query will search the category table for the slug column that matches the category filter
        $query->when($filters['category'] ?? false, fn($query, $category) => $query
            ->whereHas('category', fn($query) => $query
                ->where('slug', $category)));

        $query->when($filters['author'] ?? false, fn($query, $author) => $query
            ->whereHas('author', fn($query) => $query
                ->where('username', $author)));
    }
}
// what is the difference between the two scopeSearchFilter methods?
