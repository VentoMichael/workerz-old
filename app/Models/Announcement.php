<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    use Likable;
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopePublished($query)
    {
        return $query->where('is_draft', '=', '0');
    }

    public function scopeAdspayed($query)
    {
        return $query->where('plan_announcement_id', '!=', '1');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function startmonth()
    {
        return $this->belongsTo(StartMonth::class, 'start_month_id');
    }

    public function plan()
    {
        return $this->belongsTo(PlanAnnouncement::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
