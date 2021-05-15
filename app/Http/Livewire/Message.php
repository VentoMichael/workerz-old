<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Message extends Component
{
    public $name = "";
    public $surname = "";
    public $email = "";
    public $subject = "";
    public $message = "";

    public function register()
    {
        $data = $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'subject' => 'required',
            'message' => 'required',
        ]);
        if (request()->has('surname')) {
            $surname = $data['surname'];
        } else {
            $surname = null;
        }
        Contact::create([
            'name' => $data['name'],
            'surname' => $surname,
            'email' => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['message'],
        ]);
        return Redirect::back();
    }

    public function render()
    {
        return view('livewire.message');
    }
}
