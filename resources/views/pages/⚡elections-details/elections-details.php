<?php

use App\Models\Election;
use App\Models\Vote;
use Livewire\Component;

new class extends Component {
    public Election $election;

    public function mount(Election $election): void
    {
        $this->election = $election->loadCount('candidates');
    }

    public function with(): array
    {
        return [
            'candidates' => $this->election->candidates()->get(),
            'userHasVoted' => Vote::where('user_id', auth()->id())
                ->where('election_id', $this->election->id)
                ->exists(),
        ];
    }
};