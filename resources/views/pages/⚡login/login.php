<?php

use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    #[Validate('required|email')]
    public ?string $email = "";

    #[Validate('required|min:8')]
    public ?string $password = "";

    public function login()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (!Auth::attempt($credentials)) {
            session()->flash('feedback', ['message' => 'Invalid email or password', 'type' => 'error']);
            return;
        }

        session()->flash('feedback', [
            'message' => 'Login successful! Redirecting to dashboard...',
            'type' => 'success',
        ]);

        $this->js("setTimeout(() => window.location.href = '" . (Auth::user()->is_admin ? route('admin.dashboard') : route('account.dashboard')) . "', 2000)");
        // return redirect()->route(Auth::user()->is_admin ? 'admin.dashboard' : 'account.dashboard');
    }
};