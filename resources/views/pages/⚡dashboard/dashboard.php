<?php

use App\Models\Election;
use App\Models\Vote;
use Livewire\Component;

new class extends Component {
    public function with(): array
    {
        $userId = auth()->id();

        $votedElectionIds = Vote::where('user_id', $userId)->pluck('election_id');

        $activeElections = Election::where('status', 'active')
            ->withCount('candidates')
            ->get()
            ->map(fn($election) => tap(
                $election,
                fn($e) =>
                $e->user_has_voted = $votedElectionIds->contains($e->id)
            ));
        $upcomingElections = Election::where('status', 'upcoming')
            ->withCount('candidates')
            ->orderBy('start_date')
            ->get();

        $votedElections = Election::whereIn('id', $votedElectionIds)
            ->get()
            ->map(function ($election) use ($userId) {
                $vote = Vote::where('user_id', $userId)
                    ->where('election_id', $election->id)
                    ->with('candidate')
                    ->first();
                $election->your_candidate = $vote?->candidate?->full_name ?? 'Unknown';
                return $election;
            });

        return [
            'activeElections' => $activeElections,
            'votedElections' => $votedElections,
            'upcomingElections' => $upcomingElections,
        ];
    }
};