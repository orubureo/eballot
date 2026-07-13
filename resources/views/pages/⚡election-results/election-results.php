<?php

use App\Models\Election;
use App\Models\Vote;
use Livewire\Component;

new class extends Component {
    public Election $election;

    public function mount(Election $election): void
    {
        $user = auth()->user();

        $hasVoted = Vote::where('user_id', $user->id)
            ->where('election_id', $election->id)
            ->exists();

        if (!$hasVoted) {
            $this->redirectRoute('account.dashboard', navigate: true);
            return;
        }

        $this->election = $election;
    }

    public function with(): array
    {
        $totalVotes = $this->election->votes()->count();

        $candidates = $this->election->candidates()
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

        $userVote = Vote::where('user_id', auth()->id())
            ->where('election_id', $this->election->id)
            ->with('candidate')
            ->first();

        return [
            'candidates' => $candidates,
            'totalVotes' => $totalVotes,
            'yourCandidate' => $userVote?->candidate?->full_name,
        ];
    }
};