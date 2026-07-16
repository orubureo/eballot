<div>
    <div class="px-2 md:px-5 py-10 md:py-10">

        <a href="{{ route('account.dashboard') }}" wire:navigate
            class="text-sm text-base-content/60 hover:text-primary inline-flex items-center gap-1 mb-4">
            <i class="bi bi-arrow-left"></i>
            Back to dashboard
        </a>

        <div class="mb-6 rounded-2xl">
            <h1 class="text-xl font-semibold">Elections</h1>
            <p class="text-sm text-base-content/60 mt-1">Browse and participate in ongoing elections</p>
        </div>

        @if (session('error'))
            <div role="alert" class="alert alert-error mb-4">
                <i class="bi bi-exclamation-circle-fill text-lg"></i>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        {{-- Search --}}
        <label class="input input-bordered flex items-center gap-2 w-full mb-4 bg-white">
            <i class="bi bi-search text-base-content/40"></i>
            <input type="text" wire:model.live.debounce.400ms="search" class="grow" placeholder="Search elections..." />
        </label>

        {{-- Filter tabs --}}
        <div class="flex items-center gap-1 mb-4">
            <button wire:click="setFilter('all')"
                class="btn btn-sm {{ $filter === 'all' ? 'btn-primary' : 'btn-ghost' }}">All</button>
            <button wire:click="setFilter('active')"
                class="btn btn-sm {{ $filter === 'active' ? 'btn-primary' : 'btn-ghost' }}">Active</button>
            <button wire:click="setFilter('upcoming')"
                class="btn btn-sm {{ $filter === 'upcoming' ? 'btn-primary' : 'btn-ghost' }}">Upcoming</button>
            <button wire:click="setFilter('closed')"
                class="btn btn-sm {{ $filter === 'closed' ? 'btn-primary' : 'btn-ghost' }}">Closed</button>
        </div>

        @if ($elections->isEmpty())
            <div class="card bg-white border border-base-300 p-8 text-center">
                <i class="bi bi-calendar-x text-3xl text-base-content/20 mb-2"></i>
                <p class="text-sm text-base-content/50">No elections found.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($elections as $election)
                        <div class="card bg-white border border-base-300 rounded-2xl overflow-hidden mb-4">
                            <div class="card-body">
                                <div class="flex items-start justify-between gap-3 mb-2">
                                    <h3 class="font-semibold">{{ $election->title }}</h3>
                                    <span class="badge badge-sm gap-1 shrink-0
                                                                                                                                                                                                                                    {{ match ($election->status) {
                        'active' => 'badge-success badge-soft',
                        'upcoming' => 'badge-warning badge-soft',
                        default => 'badge-neutral badge-soft',
                    } }}">
                                        {{ match ($election->status) {
                        'active' => 'Ongoing',
                        'upcoming' => 'Upcoming',
                        default => 'Closed',
                    } }}
                                    </span>
                                </div>

                                <p class="text-sm text-base-content/50 flex items-center gap-1 mb-1">
                                    <i class="bi bi-calendar3"></i>
                                    {{ $election->start_date->format('M j, Y') }} - {{ $election->end_date->format('M j, Y') }}
                                </p>
                                <p class="text-sm text-base-content/50 flex items-center gap-1 mb-4">
                                    <i class="bi bi-people"></i>
                                    {{ $election->candidates_count }} Candidates
                                </p>

                                <div class="flex gap-2">
                                    <a href="{{ route('account.elections.details', $election) }}" wire:navigate
                                        class="btn btn-outline btn-sm flex-1">View Details
                                    </a>

                                    <a href="{{ route('account.results', $election) }}" wire:navigate
                                        class="btn btn-primary btn-sm flex-1">View Results
                                    </a>

                                    @if ($election->status === 'active')
                                        @if ($election->user_has_voted)
                                            <span class="btn btn-sm flex-1 gap-1">
                                                <i class="bi bi-check-circle"></i> Voted
                                            </span>
                                        @elseif (!auth()->user()->verified_at)
                                            <span class="btn btn-disabled btn-sm flex-1">Pending verification</span>
                                        @else
                                            <a href="{{ route('account.vote', $election) }}" wire:navigate
                                                class="btn btn-primary btn-sm flex-1">Vote Now</a>
                                        @endif
                                    @elseif ($election->status === 'closed')
                                        <span class="btn btn-sm flex-1 gap-1">
                                            <i class="bi bi-check-circle"></i> Vote Now
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                @endforeach
            </div>
        @endif

        <div class="mt-4">
            {{ $elections->links() }}
        </div>
    </div>
</div>