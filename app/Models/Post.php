<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where(
                fn ($query) =>
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
            )
        );

       
        $query->when($filters['category'] ?? false, 
            fn ($query, $category) =>
            $query->whereHas(
                'category',
                fn ($query) =>
                $query->where('slug', $category)
            )
        );

        $query->when(
            $filters['user'] ?? false,
            fn($query, $user) => 
            $query->whereHas('user', 
            fn($query) =>
            $query->where('name', $user)
            ) 
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function postView()
    {
        return $this->hasMany(PostView::class);
    }

    public function showPost()
    {
        if (auth()->id() == null) {
            return $this->postView()
                ->where('ip', '=',  request()->ip())->exists();
        }

        return $this->postView()
        ->where(function ($postViewsQuery) {
            $postViewsQuery
                ->where('session_id', '=', request()->getSession()->getId())
                ->orWhere('user_id', '=', (auth()->check()));
        })->exists();
    }
}