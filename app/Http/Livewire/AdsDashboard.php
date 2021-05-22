<?php

namespace App\Http\Livewire;

use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdsDashboard extends Component
{
    public $search = "";
    protected $queryString = ['search'];
    public function render()
    {
        sleep(1);
        return view('livewire.ads-dashboard',[
            'firstAd' => Auth::user()->announcements()->Draft()->first(),
            'announcements' => Announcement::query()->where('user_id','=',auth()->user()->id)->NotDraft()
                ->orderBy('title', 'ASC')
                ->orderBy('view_count', 'DESC')
                ->withLikes()
                ->where('title', 'like',
                    '%'.$this->search.'%')
            ->get()
        ]);
    }
}
