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
    public $provinces = [];
    public $categoryUser = [];
    public $helpText = "";
    protected $queryString = [
        'search', 'provinces',
        'categoryUser'
    ];
    public function render()
    {
         if (strlen($this->search) > 1) {
             sleep(.7);
            $workerz = User::query()
                ->orderBy('plan_user_id', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->with('categoryUser')
                ->when(
                    $this->categoryUser,
                    function ($query) {
                        return $query->whereHas(
                            'categoryUser',
                            function ($query) {
                                return $query->whereIn('category_id', $this->categoryUser);
                            }
                        );
                    }
                )
                ->when(
                    $this->provinces,
                    function ($query) {
                        return $query->whereHas(
                            'adresses',
                            function ($query) {
                                return $query->whereIn('province_id', $this->provinces);
                            }
                        );
                    }
                )
                ->withLikes()
                ->Independent()
                ->Payed()
                ->NoBan()
                ->where('job', 'like', '%'.$this->search.'%')
                ->paginate(4)
                ->onEachSide(0);
                $this->helpText = '';
        } else {
            if (strlen($this->search) === 1) {
               $this->helpText = '3 caractères minimum';
            }else{
                $this->helpText = '';
            }
            $workerz = User::orderBy('plan_user_id', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->with('categoryUser')
                ->withLikes()
                ->Independent()
                ->Payed()
                ->NoBan()
                ->paginate(4)
                ->onEachSide(0);
        }
        return view('livewire.users', [
            'newsletterValidated' => request()->session()->get('newsletter'),
            'regions' => Province::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
            'workerz' => $workerz,
            'helpText' => $this->helpText,
        ]);
    }
}
