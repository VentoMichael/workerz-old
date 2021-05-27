<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Province;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $search = "";
    public $provinces=[];
    public $categoryUser=[];
    protected $queryString = ['search','provinces',
'categoryUser'];

    public function render()
    {
        sleep(1);
        return view('livewire.users', [
            'regions' => Province::with(['users'=>function($q){
                $q->NoBan()->Payed()->withCount('provinces');
            }])->orderBy('name')->get(),
            'categories' => Category::with(['users'=>function($q){
                $q->NoBan()->Payed()->withCount('categoryUser');
            }])->orderBy('name')->get(),
            'workerz' => User::query()
                ->Independent()
                ->Payed()
                ->NoBan()
                ->orderBy('plan_user_id', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->when(
                    $this->categoryUser,
                    fn($query) => $query->whereHas(
                        'categoryUser',
                        fn($query) => $query->whereIn('category_id', $this->categoryUser)
                    )
                )
                ->when(
                    $this->provinces,
                    fn($query) => $query->whereHas(
                        'adresses',
                        fn($query) => $query->whereIn('province_id', $this->provinces)
                    )
                )
                ->withLikes()
                ->where('name', 'like', '%'.$this->search.'%')
                ->paginate(4)
                ->onEachSide(0),
        ]);
    }
}
