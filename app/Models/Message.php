<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;
    protected $table = "messages";
    protected $guarded = [];
    protected $dates = ['created_at', 'read_at'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'to_id');
    }
}
