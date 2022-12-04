<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

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
            $filters['tag'] ?? false,
            fn ($query, $tag) =>
            $query->whereHas(
                'tags',
                fn ($query) =>
                $query->where('slug', $tag)
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

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'tag_post');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function postViews()
    {
        return $this->hasMany(PostView::class);
    }

    public function showPost()
    {
        if (auth()->id() == null) {
            return $this->postViews()
                ->where('ip', '=',  request()->ip())->exists();
        }

        return $this->postViews()
        ->where(function ($postViewsQuery) {
            $postViewsQuery
                ->where('session_id', '=', request()->getSession()->getId())
                ->orWhere('user_id', '=', (auth()->check()));
        })->exists();
    }
}