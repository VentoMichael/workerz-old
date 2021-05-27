<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Announcement extends Model
{
    use HasFactory;
    use Likable;
    use Notifiable;

    protected $guarded = [];
    protected $table = 'announcements';
    protected $dates = ['created_at','end_plan'];


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function incrementReadCount()
    {
        $this->view_count++;
        return $this->save();
    }

    public function scopePublished($query)
    {
        return $query->where('is_draft', '=', false);
    }

    public function scopeAdspayed($query)
    {
        return $query->where('plan_announcement_id', '!=', '1');
    }

    public function scopeNoBan($query)
    {
        return $query->where('banned', '=', '0');
    }

    public function scopePayement($query)
    {
        return $query->where('is_payed', '=', '1');
    }
    public function scopeDraft($query)
    {
        return $query->where('is_draft', '=', '1');
    }
    public function scopeNotDraft($query)
    {
        return $query->where('is_draft', '=', '0');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPicAttribute($value)
    {
        return asset($value);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function startmonth()
    {
        return $this->belongsTo(StartMonth::class, 'start_month_id');
    }

    public function plan_announcement()
    {
        return $this->belongsTo(PlanAnnouncement::class);
    }

    public function categoryAds()
    {
        return $this->belongsToMany(Category::class);
    }
}
