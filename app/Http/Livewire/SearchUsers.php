<?php

namespace App\Http\Livewire;

use App\Models\Announcement;
use App\Models\User;
use Livewire\Component;

class SearchUsers extends Component
{
    public $search = "";

    protected $queryString = ['search'];
    public function render()
    {
        sleep(1);
        return view('livewire.search-users', [
            'workerz' => User::Independent()->Payed()->NoBan()->orderBy('plan_user_id', 'DESC')->orderBy('created_at', 'DESC')->where('name','like','%'.$this->search.'%')->paginate(3),
        ]);
    }
}
