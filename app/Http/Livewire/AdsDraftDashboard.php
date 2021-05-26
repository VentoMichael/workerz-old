<?php

namespace App\Http\Livewire;

use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdsDraftDashboard extends Component
{
    public $search = "";
    protected $queryString = ['search'];
    public function render()
    {
        sleep(1);
        return view('livewire.ads-draft-dashboard',[
            'firstAdDraft' => Auth::user()->announcements()->Draft()->inRandomOrder()->first(),
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
