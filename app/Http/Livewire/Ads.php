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
    public $filters = [
        'province' => [],
        'categoryAds' => [],
    ];

    protected $queryString = ['search'];

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function render()
    {
        sleep(1);
        return view('livewire.ads', [
            'regions' => Province::withCount("announcements")->get()->sortBy('name'),
            'categories' => Category::withCount("announcements")->get()->sortBy('name'),
            'user' => auth()->user(),
            'announcements' => Announcement::query()->Published()
                ->NoBan()
                ->Payement()
                ->orderBy('plan_announcement_id', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->when(
                    $this->filters['categoryAds'],
                    fn($query) => $query->whereHas(
                        'categoryAds',
                        fn($query) => $query->whereIn('category_id', $this->filters['categoryAds'])
                    )
                )
                ->when(
                    $this->filters['province'],
                    fn($query) => $query->whereHas(
                        'province',
                        fn($query) => $query->whereIn('province_id', $this->filters['province'])
                    ))
                ->withLikes()
                ->where('title', 'like',
                    '%'.$this
                        ->search.'%')
                ->paginate(4)
                ->onEachSide(0),
        ]);
    }
}
