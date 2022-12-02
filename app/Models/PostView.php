<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostView extends Model
{
    use HasFactory;

    /**
     * Scope a query to only include the last n days records
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereDateBetween($query, $fieldName, $fromDate, $todate)
    {
        return $query->whereDate($fieldName, '>=', $fromDate)->whereDate($fieldName, '<=', $todate);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public static function createViewLog($post)
    {
        $postViews = new PostView();
        $postViews->post_id = $post->id;
        $postViews->slug = $post->slug;
        $postViews->url = request()->url();
        $postViews->session_id = request()->getSession()->getId();
        $postViews->user_id = (auth()->check()) ? auth()->id() : null;
        $postViews->country_id = 1;
        $postViews->ip = request()->ip();
        $postViews->agent = request()->header('User-Agent');
        $postViews->save();
    }
}
