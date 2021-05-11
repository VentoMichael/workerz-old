<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    use LikableUser;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $dates = ['created_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:Y-m-d h:i:s',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getPicAttribute($value)
    {
        return asset($value);
    }
    public function scopeIndependent($query)
    {
        return $query->where('role_id', '=', '2');
    }

    public function scopeUser($query)
    {
        return $query->where('role_id', '=', '3');
    }

    public function scopeNoBan($query)
    {
        return $query->where('banned', '=', false);
    }

    public function scopePayed($query)
    {
        return $query->where('is_payed', '=', true);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function plan_user()
    {
        return $this->belongsTo(PlanUser::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class, 'user_id');
    }

    public function websites()
    {
        return $this->hasMany(Website::class);
    }

    public function likes()
    {
        return $this->hasMany(LikeAnnouncement::class);
    }

    public function categoryUser()
    {
        return $this->belongsToMany(Category::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Province::class);
    }

    public function startDate()
    {
        return $this->belongsToMany(StartDate::class)->orderBy('id', 'ASC');
    }

}
