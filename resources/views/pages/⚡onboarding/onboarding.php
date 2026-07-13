<?php

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;

new class extends Component {

    use WithFileUploads;

    #[Validate('required|string|max:255')]
    public ?string $full_names = "";

    #[Validate('required|email|unique:users,email|max:255')]
    public ?string $email = "";

    #[Validate('required|string|unique:users,phone_number|min:11|max:15')]
    public ?string $phone_number = "";

    #[Validate('required|string|in:male,female')]
    public ?string $gender = "";

    #[Validate('required|string|in:nin,voters_card')]
    public ?string $document_type = "";

    #[Validate('required|file|mimes:jpg,png,jpeg|max:10240')]
    public $document;

    #[Validate('required|string|min:8|confirmed')]
    public ?string $password = "";

    public ?string $password_confirmation = "";

    public function createAccount()
    {
        $this->validate();

        $document_path = null;

        if ($this->document) {
            $document_path = $this->document->store('documents', 'public');
        }

        $user = User::create([
            "full_names" => $this->full_names,
            "email" => $this->email,
            "phone_number" => $this->phone_number,
            "gender" => $this->gender,
            "document_type" => $this->document_type,
            "document" => $document_path,
            "password" => $this->password,
            "is_admin" => false,
        ]);

        if ($user) {
            session()->flash('feedback', ['message' => 'Account created successfully! Redirecting to login...', 'type' => 'success',]);

            $this->reset(...);

            $this->js("setTimeout(() => window.location.href = '" . route('login') . "', 2000)");
        }
    }
};