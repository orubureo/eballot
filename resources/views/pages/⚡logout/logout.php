<?php

use Livewire\Component;

new class extends Component {


    public function mount(): void
    {
        // Log out the authenticated user from the default guard
        Auth::logout();

        // Invalidate the current session to prevent session fixation attacks
        session()->invalidate();

        // Regenerate the CSRF token to prevent cross-site request forgery
        session()->regenerateToken();

        // Redirect to the login page
        $this->redirect(route('home'), navigate: true);
    }

};