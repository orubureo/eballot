<?php

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public string $filter = 'all';
    public string $search = '';
    public int $pendingCount = 0;
    public int $verifiedCount = 0;
    public array $voters = [];

    public function mount(): void
    {
        $this->loadVoters();
    }

    public function loadVoters(): void
    {
        $query = User::where('is_admin', false);

        if ($this->filter === 'pending') {
            $query->whereNull('verified_at');
        } elseif ($this->filter === 'verified') {
            $query->whereNotNull('verified_at');
        }

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('full_names', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%");
            });
        }

        $this->voters = $query->latest()->get()->toArray();
        $this->pendingCount = User::where('is_admin', false)->whereNull('verified_at')->count();
        $this->verifiedCount = User::where('is_admin', false)->whereNotNull('verified_at')->count();
    }

    public function updatedFilter(): void
    {
        $this->loadVoters();
    }

    public function updatedSearch(): void
    {
        $this->loadVoters();
    }

    public function verify(int $id): void
    {
        User::where('is_admin', false)->findOrFail($id)->update(['verified_at' => now()]);
        $this->loadVoters();
    }

    public function unverify(int $id): void
    {
        User::where('is_admin', false)->findOrFail($id)->update(['verified_at' => null]);
        $this->loadVoters();
    }
};