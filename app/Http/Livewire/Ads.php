<?php

namespace App\Http\Livewire;

use App\Models\Announcement;
use App\Models\Category;
use App\Models\Province;
use Livewire\Component;
use Livewire\WithPagination;

class Ads extends Component
{
    use WithPagination;

    public $search = "";
    //public $regions = "";

    public function render()
    {
        sleep(1);
        return view('livewire.ads', [
            'announcements' => Announcement::Published()->NoBan()->Payement()->orderBy('plan_announcement_id',
                'DESC')->orderBy('created_at', 'DESC')->withLikes()->where('title','like','%'.$this->search.'%')->paginate(4)->onEachSide(0),
            'regions' => Category::withCount("announcements")->get()->sortBy('name'),
            'categories' => Province::withCount("announcements")->get()->sortBy('name'),
        ]);
    }
}
