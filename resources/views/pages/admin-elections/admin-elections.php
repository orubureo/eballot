<?php

use App\Models\Election;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public bool $showModal = false;

    public ?int $editingId = null;

    public string $title = '';

    public string $description = '';

    public string $start_date = '';

    public string $end_date = '';

    public function with(): array
    {
        return [
            'elections' => Election::withCount(['candidates', 'votes'])->latest()->paginate(10),
            'eligibleVoters' => User::whereNotNull('verified_at')->count(),
        ];
    }

    public function create(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit(int $id): void
    {
        $election = Election::findOrFail($id);

        $this->editingId = $election->id;
        $this->title = $election->title;
        $this->description = $election->description ?? '';
        $this->start_date = $election->start_date->format('Y-m-d\TH:i');
        $this->end_date = $election->end_date->format('Y-m-d\TH:i');
        $this->showModal = true;
    }

    public function save(): void
    {
        $validated = $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        if ($this->editingId) {
            Election::findOrFail($this->editingId)->update($validated);
        } else {
            Election::create([...$validated, 'created_by' => Auth::id()]);
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function delete(int $id): void
    {
        Election::findOrFail($id)->delete();
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->editingId = null;
        $this->title = '';
        $this->description = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->resetErrorBag();
    }
};