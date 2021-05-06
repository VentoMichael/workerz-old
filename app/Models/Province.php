<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    public function users(){
        return $this->belongsToMany(User::class)->withPivot('physical_adress_id');
    }
    public function announcements(){
        return $this->hasMany(Announcement::class);
    }
    public function physicalAdresses(){
        return $this->hasMany(PhysicalAdress::class,'physical_adress_id');
    }
}
