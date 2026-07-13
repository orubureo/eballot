<?php

use App\Models\Election;
use App\Models\User;
use App\Models\Vote;
use Livewire\Component;

new class extends Component {

    public int $totalElections = 0;
    public int $activeElections = 0;
    public int $registeredVoters = 0;
    public int $votesCast = 0;

    public function mount(): void
    {
        $this->refreshStats();
    }

    public function refreshStats(): void
    {
        $this->totalElections = Election::count();
        $this->activeElections = Election::where('status', 'active')->count();
        $this->registeredVoters = User::where('is_admin', false)->count();
        $this->votesCast = Vote::count();
    }

    public function with(): array
    {
        $eligibleVoters = User::whereNotNull('verified_at')->count();

        return [
            'elections' => Election::withCount(['candidates', 'votes'])
                ->latest()
                ->take(4)
                ->get()
                ->map(fn(Election $election) => [
                    'title' => $election->title,
                    'candidates' => $election->candidates_count,
                    'status' => $election->status,
                    'window' => $this->formatWindow($election),
                    'turnout' => $eligibleVoters > 0 ? round(($election->votes_count / $eligibleVoters) * 100, 1) : null,
                ]),

            'recentActivity' => $this->loadRecentActivity(),
        ];
    }

    private function formatWindow(Election $election): string
    {
        return match ($election->status) {
            'active' => 'Ends ' . $election->end_date->diffForHumans(),
            'upcoming' => 'Starts ' . $election->start_date->diffForHumans(),
            'closed' => 'Ended ' . $election->end_date->diffForHumans(),
            default => 'Not scheduled',
        };
    }

    protected function loadRecentActivity(): array
    {
        $activities = collect();

        Election::query()
            ->latest('created_at')
            ->take(3)
            ->get()
            ->each(function (Election $election) use ($activities) {
                $activities->push([
                    'message' => "Election \"{$election->title}\" was created",
                    'time' => $election->created_at->diffForHumans(),
                    'icon' => null,
                    'sort' => $election->created_at,
                ]);
            });

        User::query()
            ->where('is_admin', false)
            ->whereNotNull('verified_at')
            ->latest('verified_at')
            ->take(3)
            ->get()
            ->each(function (User $user) use ($activities) {
                $activities->push([
                    'message' => "{$user->full_names} was verified as a voter",
                    'time' => $user->verified_at->diffForHumans(),
                    'icon' => null,
                    'sort' => $user->verified_at,
                ]);
            });

        Vote::query()
            ->with('election:id,title')
            ->latest('created_at')
            ->take(3)
            ->get()
            ->each(function (Vote $vote) use ($activities) {
                $activities->push([
                    'message' => 'A vote was cast in ' . ($vote->election->title ?? 'an election'),
                    'time' => $vote->created_at->diffForHumans(),
                    'icon' => null,
                    'sort' => $vote->created_at,
                ]);
            });

        return $activities
            ->sortByDesc('sort')
            ->take(5)
            ->values()
            ->toArray();
    }
};