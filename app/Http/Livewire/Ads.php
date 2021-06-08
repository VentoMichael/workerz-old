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
    public $helpText = "";
    public $categoryAds=[];
    protected $queryString = ['search','province','categoryAds'];

    public function render()
    {
        if (strlen($this->search) > 1) {
             sleep(.7);
             $announcements = Announcement::query()
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
                ->where('job', 'like',
                    '%'.$this
                        ->search.'%')
                ->paginate(4)
                ->onEachSide(0);
                $this->helpText = '';
        } else {
            if (strlen($this->search) === 1) {
               $this->helpText = '3 caractères minimum';
            }else{
                $this->helpText = '';
            }
            $announcements = Announcement::Published()
                ->NoBan()
                ->Payement()
                ->orderBy('plan_announcement_id', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->withLikes()
                ->paginate(4)
                ->onEachSide(0);
        }
        return view('livewire.ads', [
            'newsletterValidated' => request()->session()->get('newsletter'),
            'regions' => Province::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
            'user' => auth()->user(),
            'announcements' => $announcements,
            'helpText' => $this->helpText,
        ]);
    }
}
