<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartMonth extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function announcements(){
        return $this->hasMany(Announcement::class);
    }
}
