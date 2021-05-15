<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\PhysicalAdress;
use App\Models\Province;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\Console\Input\Input;

class Users extends Component
{
    use WithPagination;

    public $search = "";
    public $filters = [
        'provinces' => [],
        'categoryUser' => [],
    ];

    protected $queryString = ['search'];

    public function resetFilters(){
        $this->reset('filters');
    }
    public function render()
    {

        sleep(1);
        return view('livewire.users', [
            'regions' => Province::withCount("users")->get()->sortBy('name'),
            'categories' => Category::withCount("users")->get()->sortBy('name'),
            'workerz' => User::query()
                ->Independent()
                ->Payed()
                ->NoBan()
                ->orderBy('plan_user_id', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->when(
                    $this->filters['categoryUser'],
                    fn($query, $role) => $query->whereHas(
                        'categoryUser',
                        fn($query) => $query->whereIn('category_id', $this->filters['categoryUser'])
                    )
                )
                ->when(
                    $this->filters['provinces'],
                    fn($query, $role) => $query->whereHas(
                        'adresses',
                        fn($query) => $query->whereIn('province_id', $this->filters['provinces'])
                    )
                )
                ->withLikes()
                ->where('name', 'like', '%'.$this->search.'%')
                ->paginate(4)
                ->onEachSide(0),
        ]);
    }
}
