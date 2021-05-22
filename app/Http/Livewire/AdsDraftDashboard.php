<?php

namespace App\Http\Livewire;

use App\Models\Announcement;
use Livewire\Component;

class AdsDraftDashboard extends Component
{
    public $search = "";
    protected $queryString = ['search'];
    public function render()
    {

        return view('livewire.ads-draft-dashboard',[
            'announcements' => Announcement::query()->where('user_id','=',auth()->user()->id)->Draft()
                ->orderBy('title', 'ASC')
                ->orderBy('view_count', 'DESC')
                ->withLikes()
                ->where('title', 'like',
                    '%'.$this->search.'%')
                ->get()
        ]);
    }
}
