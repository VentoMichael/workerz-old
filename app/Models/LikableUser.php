<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Builder;

trait LikableUser
{
    public function scopeWithLikes(Builder $query)
    {
        $query->leftJoinSub(
            'select customer_id, sum(liked) likes from like_users group by customer_id',
            'like_users',
            'like_users.customer_id',
            'users.id',
        );
    }

    public function dislikeU($user = null)
    {
        return $this->likeU($user, false);
    }


    public function isLikedUBy(User $user)
    {
        return (bool) $user->likesU
            ->where('customer_id', $this->id)
            ->where('liked', true)
            ->count();
    }

    public function likeU($user = null, $liked = true)
    {
        $this->likesU()->updateOrCreate([
            'user_id' =>  auth()->user()->id,
        ], [
            'liked' => $liked,
        ]);
    }


    public function likesU()
    {
        return $this->hasMany(LikeUser::class, 'customer_id');
    }


}
