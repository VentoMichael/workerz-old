<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;

trait Likable
{

    public function scopeWithLikes(Builder $query)
    {
        $query->leftJoinSub(
            'select announcement_id, sum(liked) likes from likes group by announcement_id',
            'likes',
            'likes.announcement_id',
            'announcements.id',
        );
    }

    public function dislike($user = null)
    {
        return $this->like($user, false);
    }


    public function isLikedBy(User $user)
    {
        return (bool) $user->likes
            ->where('announcement_id', $this->id)
            ->where('liked', true)
            ->count();
    }

    public function like($user = null, $liked = true)
    {
        $this->likes()->updateOrCreate([
            'user_id' => $user = auth()->user()->id,
        ], [
            'liked' => $liked,
        ]);
    }


    public function likes()
    {
        return $this->belongsToMany(Like::class);
    }
}
