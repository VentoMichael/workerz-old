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
    public $province=[];
    public $categoryAds=[];
    protected $queryString = ['search','province','categoryAds'];

    public function render()
    {
        sleep(1);
        return view('livewire.ads', [
            'regions' => Province::all(),
            'categories' => Category::all(),
            'user' => auth()->user(),
            'announcements' => Announcement::query()
                ->Published()
                ->NoBan()
                ->Payement()
                ->orderBy('plan_announcement_id', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->when(
                    $this->categoryAds,
                    function ($query) {
                        return $query->whereHas(
                            'categoryAds',
                            function ($query) {
                                return $query->whereIn('category_id', $this->categoryAds);
                            }
                        );
                    }
                )
                ->when(
                    $this->province,
                    function ($query) {
                        return $query->whereHas(
                            'province',
                            function ($query) {
                                return $query->whereIn('province_id', $this->province);
                            }
                        );
                    })
                ->withLikes()
                ->where('title', 'like',
                    '%'.$this
                        ->search.'%')
                ->paginate(4)
                ->onEachSide(0),
        ]);
    }
}
