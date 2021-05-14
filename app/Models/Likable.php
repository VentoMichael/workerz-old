<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;

trait Likable
{

    public function scopeWithLikes(Builder $query)
    {
        $query->leftJoinSub(
            'select announcement_id, sum(liked) likes from wo_like_announcements group by announcement_id',
            'like_announcements',
            'like_announcements.announcement_id',
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
            'user_id' => auth()->user()->id
        ], [
            'liked' => $liked,
        ]);
    }


    public function likes()
    {
        return $this->hasMany(LikeAnnouncement::class);
    }

}
