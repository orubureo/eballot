<?php

use App\Models\Election;
use App\Models\Vote;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    public Election $election;

    #[Validate('required|integer|exists:candidates,id')]
    public ?int $selectedCandidate = null;

    public function mount(Election $election): void
    {
        $user = auth()->user();

        if (!$user->verified_at) {
            session()->flash('error', 'Your account must be verified before you can vote.');
            $this->redirectRoute('account.dashboard', navigate: true);
            return;
        }

        $alreadyVoted = Vote::where('user_id', $user->id)
            ->where('election_id', $election->id)
            ->exists();

        if ($alreadyVoted) {
            session()->flash('error', 'You have already voted in this election.');
            $this->redirectRoute('account.dashboard', navigate: true);
            return;
        }

        if ($election->status !== 'active') {
            session()->flash('error', 'This election is not currently active.');
            $this->redirectRoute('account.dashboard', navigate: true);
            return;
        }

        $this->election = $election;
    }

    public function with(): array
    {
        return [
            'candidates' => $this->election->candidates()->get(),
        ];
    }

    public function castVote(): void
    {
        $this->validate();

        Vote::create([
            'election_id' => $this->election->id,
            'candidate_id' => $this->selectedCandidate,
            'user_id' => auth()->id(),
        ]);

        session()->flash('success', 'Your vote has been cast successfully!');
        $this->redirectRoute('account.dashboard', navigate: true);
    }
};