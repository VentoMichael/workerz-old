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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeIndependent($query)
    {
        return $query->where('role_id', '=', '2');
    }

    public function announcements(){
        return $this->hasMany(Announcement::class);
    }
    public function plan(){
        return $this->belongsTo(PlanUser::class);
    }
    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function phones(){
        return $this->hasMany(Phone::class,'user_id');
    }
    public function websites(){
        return $this->hasMany(Website::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function startDateUser(){
        return $this->belongsToMany(StartDate::class)->orderBy('id', 'ASC');
    }
    public function province(){
        return $this->belongsTo(Province::class);
    }
}
