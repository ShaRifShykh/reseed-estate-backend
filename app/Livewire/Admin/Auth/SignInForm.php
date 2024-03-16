<?php

namespace App\Livewire\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SignInForm extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8|string',
    ];

    public function render()
    {
        return view('livewire.admin.auth.sign-in-form');
    }

    public function signIn()
    {
        $this->validate($this->rules);

        if (Auth::guard("admin")->attempt(array("email" => $this->email, 'password' => $this->password))) {
            toastr()->success('Login Successfully!');

            return redirect()->route("admin.dashboard");
        } else {
            toastr()->error('Invalid Credentials!');
        }
    }
}
