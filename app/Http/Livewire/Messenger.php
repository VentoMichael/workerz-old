<?php

namespace App\Http\Livewire;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Messenger extends Component
{
    public $search = "";
    protected $queryString = ['search'];

    public function render()
    {
        sleep(1);
        return view('livewire.messenger',[
            'firstUser' => User::where('id','!=',auth()->user()->id)->first(),
            'users' => User::query()->join('messages', 'users.id', '=', 'messages.to_id')
                ->with('messages')
                ->where('users.id','!=',\auth()->user()->id)
                ->where('name', 'like',
                    '%'.$this->search.'%')
                ->get(['users.*']),
        ]);
    }
}
