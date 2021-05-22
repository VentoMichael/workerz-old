<?php

namespace App\Http\Livewire;

use App\Models\Announcement;
use Livewire\Component;

class AdsDashboard extends Component
{
    public $search = "";
    protected $queryString = ['search'];
    public function render()
    {
        return view('livewire.ads-dashboard',[
            'announcements' => Announcement::query()->where('user_id','=',auth()->user()->id)
                ->orderBy('title', 'ASC')
                ->orderBy('view_count', 'DESC')
                ->withLikes()
                ->where('title', 'like',
                    '%'.$this->search.'%')
            ->get()
        ]);
    }
}
