<?php

namespace App\Http\Livewire;

use App\Models\Announcement;
use App\Models\User;
use Livewire\Component;

class SearchUsers extends Component
{
    public $search = "";
    public $helpText = "";
    protected $queryString = ['search'];
    public function render()
    {
        if (strlen($this->search) > 1) {
             sleep(1);
             $workerz = User::Independent()
             ->Payed()
             ->NoBan()
             ->orderBy('plan_user_id', 'DESC')
             ->orderBy('created_at', 'DESC')
             ->where('name','like','%'.$this->search.'%')
             ->orWhere('job','like','%'.$this->search.'%')
             ->paginate(3);
            $this->helpText = '';
        } else {
            if (strlen($this->search) === 1) {
               $this->helpText = 'Il faut 2 caractères minimum';
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
        return view('livewire.search-users', [
            'workerz' => $workerz,
            'helpText' => $this->helpText,
        ]);
    }
}
