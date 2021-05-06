<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function announcements(){
        return $this->hasMany(Announcement::class);
    }
}
