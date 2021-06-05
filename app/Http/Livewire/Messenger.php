<?php

namespace App\Http\Livewire;

use App\Models\Announcement;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Query\Builder;
use Livewire\Component;

class Messenger extends Component
{
    public $search = "";
    protected $queryString = ['search'];

    public function render()
    {
        sleep(1);
        return view('livewire.messenger', [
            'firstUser' => User::where('id', '!=', auth()->user()->id)->first(),
            'users' => User::query()->whereHas('relatedTo', function ($q) {
                $q->where('to_id', \auth()->id());
            })->where('name', 'like',
                '%'.$this->search.'%')->get()

        ]);
    }
}
