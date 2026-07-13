<?php

use App\Models\Election;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public Election $election;
    public bool $showModal = false;
    public ?int $editingId = null;
    public string $full_name = '';
    public $photo = null;
    public ?string $existingPhoto = null;
    public bool $removePhoto = false;

    public function mount(Election $election): void
    {
        $this->election = $election;
    }

    public function with(): array
    {
        return [
            'candidates' => $this->election->candidates()->latest()->get(),
        ];
    }

    public function create(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit(int $id): void
    {
        $candidate = $this->election->candidates()->findOrFail($id);
        $this->editingId = $candidate->id;
        $this->full_name = $candidate->full_name;
        $this->existingPhoto = $candidate->photo;
        $this->photo = null;
        $this->removePhoto = false;
        $this->showModal = true;
    }

    public function clearPhoto(): void
    {
        $this->photo = null;
        $this->existingPhoto = null;
        $this->removePhoto = true;
    }

    public function save(): void
    {
        $validated = $this->validate([
            'full_name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = ['full_name' => $validated['full_name']];

        if ($this->photo) {
            $data['photo'] = $this->photo->store('candidates', 'public');
        } elseif ($this->removePhoto) {
            $data['photo'] = null;
        }

        if ($this->editingId) {
            $candidate = $this->election->candidates()->findOrFail($this->editingId);
            if (($this->photo || $this->removePhoto) && $candidate->photo) {
                Storage::disk('public')->delete($candidate->photo);
            }
            $candidate->update($data);
        } else {
            $this->election->candidates()->create($data);
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function delete(int $id): void
    {
        $candidate = $this->election->candidates()->findOrFail($id);
        if ($candidate->photo) {
            Storage::disk('public')->delete($candidate->photo);
        }
        $candidate->delete();
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->editingId = null;
        $this->full_name = '';
        $this->photo = null;
        $this->existingPhoto = null;
        $this->removePhoto = false;
        $this->resetErrorBag();
    }
};