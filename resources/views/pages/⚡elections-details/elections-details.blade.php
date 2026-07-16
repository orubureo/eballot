<div>
    <div class="px-2 md:px-5 py-10 md:py-10">
        <a href="{{ route('account.elections') }}" wire:navigate
            class="text-sm text-base-content/60 hover:text-primary inline-flex items-center gap-1 mb-4">
            <i class="bi bi-arrow-left"></i>
            Back to Elections
        </a>

        {{-- Header banner --}}
        <div class="rounded-2xl bg-linear-to-r from-primary/90 to-primary p-6 mb-6 text-primary-content">
            <h1 class="text-xl font-semibold mb-4">{{ $election->title }}</h1>
            <div class="flex flex-wrap gap-8">
                <div>
                    <p class="text-xs text-primary-content/70 flex items-center gap-1"><i class="bi bi-calendar3"></i>
                        Election Period</p>
                    <p class="font-medium mt-1">{{ $election->start_date->format('M j') }} -
                        {{ $election->end_date->format('M j, Y') }}</p>
                </div>
                <div>
                    <p class="text-xs text-primary-content/70 flex items-center gap-1"><i class="bi bi-people"></i>
                        Total Candidates</p>
                    <p class="font-medium mt-1">{{ $election->candidates_count }} Candidates</p>
                </div>
                <div>
                    <p class="text-xs text-primary-content/70 flex items-center gap-1"><i class="bi bi-geo-alt"></i>
                        Status</p>
                    <p class="font-medium mt-1">{{ match ($election->status) {
    'active' => 'Ongoing',
    'upcoming' => 'Upcoming',
    default => 'Completed',
} }}</p>
                </div>
            </div>
        </div>

        {{-- About --}}
        @if ($election->description)
            <div class="card bg-white border border-base-300 mb-6">
                <div class="card-body">
                    <h2 class="font-semibold mb-2">About this election</h2>
                    <p class="text-sm text-base-content/70">{{ $election->description }}</p>
                </div>
            </div>
        @endif

        {{-- Candidates (read-only) --}}
        <div class="mb-4">
            <h2 class="font-semibold mb-3">Candidates</h2>
            @if ($candidates->isEmpty())
                <div class="card bg-white border border-base-300 p-6 text-center text-sm text-base-content/50">
                    No candidates added yet.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($candidates as $candidate)
                        <div class="card bg-white border border-base-300">
                            <div class="card-body">
                                <div class="flex items-center gap-3">
                                    @if ($candidate->photo)
                                        <img src="{{ asset('storage/' . $candidate->photo) }}"
                                            class="size-12 rounded-full object-cover" />
                                    @else
                                        <div
                                            class="size-12 rounded-full bg-base-300 flex items-center justify-center font-semibold">
                                            {{ strtoupper(substr($candidate->full_name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <p class="font-medium">{{ $candidate->full_name }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Single vote CTA --}}
        @if ($election->status === 'active')
            <div class="card bg-white border border-base-300 p-4">
                @if ($userHasVoted)
                    <span class="btn btn-ghost w-full gap-1 pointer-events-none">
                        <i class="bi bi-check-circle"></i> You've already voted in this election
                    </span>
                @elseif (!auth()->user()->verified_at)
                    <span class="btn btn-disabled w-full">Pending verification — you can't vote yet</span>
                @else
                    <a href="{{ route('account.vote', $election) }}" wire:navigate class="btn btn-primary w-full gap-2">
                        <i class="bi bi-check2-square"></i>
                        Vote now
                    </a>
                @endif
            </div>
        @elseif ($election->status === 'closed')
            <a href="{{ route('account.results', $election) }}" wire:navigate class="btn btn-primary w-full gap-2">
                <i class="bi bi-bar-chart"></i>
                View results
            </a>
        @endif
    </div>
</div>