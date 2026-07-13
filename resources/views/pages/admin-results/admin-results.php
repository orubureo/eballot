<?php

use App\Models\Election;
use Livewire\Component;

new class extends Component {
    public ?int $selectedElection = null;

    public function mount(): void
    {
        $first = Election::latest()->first();
        if ($first) {
            $this->selectedElection = $first->id;
        }
    }

    public function with(): array
    {
        $elections = Election::orderBy('status')->latest()->get();
        $election = null;
        $candidates = collect();
        $totalVotes = 0;

        if ($this->selectedElection) {
            $election = Election::withCount('votes')->find($this->selectedElection);

            if ($election) {
                $totalVotes = $election->votes_count;
                $candidates = $election->candidates()
                    ->withCount('votes')
                    ->orderByDesc('votes_count')
                    ->get()
                    ->values()
                    ->map(fn($candidate, $index) => [
                        'id' => $candidate->id,
                        'full_name' => $candidate->full_name,
                        'photo' => $candidate->photo,
                        'votes' => $candidate->votes_count,
                        'percentage' => $totalVotes > 0
                            ? round(($candidate->votes_count / $totalVotes) * 100, 1)
                            : 0,
                        'leading' => $index === 0 && $totalVotes > 0,
                    ]);
            }
        }

        return [
            'elections' => $elections,
            'election' => $election,
            'candidates' => $candidates,
            'totalVotes' => $totalVotes,
        ];
    }
};