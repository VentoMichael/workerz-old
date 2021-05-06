<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalAdress extends Model
{
    use HasFactory;
    protected $guarded;
public function provinces(){
    return $this->hasMany(PhysicalAdress::class);
}
}
