<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $dates=['created_at','read_at'];
    public $timestamps = false;
    public function user(){
        return $this->belongsTo(User::class,'from_id');
    }
    public function unreadCount(int $userId){
        return $this->message->newQuery()->where('to_id',$userId)->groupBy('from_id')
            ->selectRaw('from_id, COUNT(id) as count')
            ->whereRaw('read at IS NULL')
            ->get()
            ->pluck('count','from_id');
    }
}
