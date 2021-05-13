<?php

namespace App\Http\Livewire;

use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use App\Models\Category;
use App\Models\Province;
use Livewire\Component;
use Livewire\WithPagination;

class Ads extends Component
{
    use WithPagination;

    public $search = "";
    public $regionSeleted = [];

    protected $queryString = ['search', 'regionSeleted'];

    public function render()
    {
        sleep(1);
        return view('livewire.ads', [
            'regions' => Province::withCount("announcements")->get()->sortBy('name'),
            'regionSeleted' => AnnouncementCategory::where('category_id', '=', 9)->get()->sortBy('name'),
            'categories' => Province::withCount("announcements")->get()->sortBy('name'),
            'announcements' => Announcement::Published()->NoBan()->Payement()->orderBy('plan_announcement_id',
                'DESC')->orderBy('created_at', 'DESC')->withLikes()->where('title', 'like',
                '%'.$this->search.'%')->paginate(4)->onEachSide(0),
        ]);
    }
}
