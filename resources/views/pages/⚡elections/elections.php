<?php

use App\Models\Election;
use App\Models\Vote;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public string $filter = 'all';
    public string $search = '';

    public function with(): array
    {
        $userId = auth()->id();
        $votedElectionIds = Vote::where('user_id', $userId)->pluck('election_id');

        $query = Election::withCount('candidates')
            ->when($this->filter === 'active', fn($q) => $q->where('status', 'active'))
            ->when($this->filter === 'upcoming', fn($q) => $q->where('status', 'upcoming'))
            ->when($this->filter === 'closed', fn($q) => $q->where('status', 'closed'))
            ->when($this->search !== '', fn($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->orderByRaw("CASE status WHEN 'active' THEN 0 WHEN 'upcoming' THEN 1 ELSE 2 END")
            ->orderBy('start_date');

        $elections = $query->paginate(8)->through(fn(Election $election) => tap(
            $election,
            fn($e) => $e->user_has_voted = $votedElectionIds->contains($e->id)
        ));

        return [
            'elections' => $elections,
        ];
    }

    public function setFilter(string $filter): void
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
};