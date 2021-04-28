<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'title';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function province(){
        return $this->belongsTo(Province::class);
    }
    public function startDateAnnouncement(){
        return $this->belongsToMany(StartDate::class);
    }
    public function plan(){
        return $this->belongsTo(PlanAnnouncement::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
