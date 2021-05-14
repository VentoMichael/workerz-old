<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Province;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\Console\Input\Input;

class Users extends Component
{
    use WithPagination;

    public $search = "";
    public $filters = [
        'categoriesSelected' => [],
        'regionsSelected' => []
    ];

    protected $queryString = ['search'];
    public function render()
    {

        sleep(1);
        return view('livewire.users', [
            'regions' => Province::withCount("users")->get()->sortBy('name'),
            'categories' => Category::withCount("users")->get()->sortBy('name'),
            'workerz' => User::withLikes()->Independent()->Payed()->NoBan()->orderBy('plan_user_id', 'DESC')->orderBy('created_at', 'DESC')->where('name', 'like', '%'.$this->search.'%')->paginate(4)->onEachSide(0),
        ]);
    }
}
