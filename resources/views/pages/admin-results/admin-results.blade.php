<div class="px-2 md:px-5 py-10 md:py-10">
    <div class="flex items-start justify-between gap-4 mb-8 p-4 -mx-4">
        <div>
            <h1 class="text-xl font-semibold">Results</h1>
            <p class="text-sm text-base-content/60 mt-1">Live vote counts per candidate</p>
        </div>
        @if ($election?->status === 'active')
            <div class="flex items-center gap-2 text-success text-sm font-medium">
                <span class="size-2 rounded-full bg-success animate-pulse inline-block"></span>
                Live — updates every 5s
            </div>
        @endif
    </div>

    <div class="mb-6">
        <select wire:model.live="selectedElection" class="select select-bordered w-full max-w-sm bg-white">
            @foreach ($elections as $e)
                <option value="{{ $e->id }}">{{ $e->title }} ({{ ucfirst($e->status) }})</option>
            @endforeach
        </select>
    </div>

    @if ($election)
        <div class="stats stats-vertical lg:stats-horizontal shadow w-full mb-6 bg-white rounded-2xl border border-base-300">
            <div class="stat">
                <div class="stat-title">Total votes</div>
                <div class="stat-value text-2xl">{{ number_format($totalVotes) }}</div>
            </div>
            <div class="stat">
                <div class="stat-title">Candidates</div>
                <div class="stat-value text-2xl">{{ $candidates->count() }}</div>
            </div>
            <div class="stat">
                <div class="stat-title">Status</div>
                <div class="stat-value text-2xl capitalize">{{ $election->status }}</div>
            </div>
            <div class="stat">
                <div class="stat-title">Closes</div>
                <div class="stat-value text-lg">{{ $election->end_date->format('M j, Y') }}</div>
            </div>
        </div>

        @if ($candidates->isEmpty())
            <div class="card bg-white rounded-2xl border border-base-300 p-8 text-center text-sm text-base-content/50">
                No candidates added to this election yet.
            </div>
        @else
            <div class="card bg-white shadow border border-base-300">
                <div class="card-body p-0">
                    <div class="px-5 py-4 border-b border-base-300 flex items-center justify-between">
                        <h2 class="font-medium">Candidate results</h2>
                        @if ($election->status === 'active')
                            <span wire:poll.5000ms="$refresh" class="text-xs text-base-content/40">Auto-refreshing</span>
                        @endif
                    </div>

                    <div class="divide-y divide-base-300">
                        @foreach ($candidates as $index => $candidate)
                            <div class="px-5 py-4">
                                <div class="flex items-center gap-4 mb-2">
                                    <span class="text-sm font-medium text-base-content/40 w-5">{{ $index + 1 }}</span>

                                    @if ($candidate['photo'])
                                        <img src="{{ asset('storage/' . $candidate['photo']) }}" class="size-9 rounded-full object-cover" />
                                    @else
                                        <div class="size-9 rounded-full bg-base-300 flex items-center justify-center text-xs font-medium">
                                            {{ strtoupper(substr($candidate['full_name'], 0, 1)) }}
                                        </div>
                                    @endif

                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2">
                                            <span class="font-medium truncate">{{ $candidate['full_name'] }}</span>
                                            @if ($candidate['leading'] && $totalVotes > 0)
                                                <span class="badge badge-success badge-sm">Leading</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="text-right shrink-0">
                                        <p class="font-semibold">{{ number_format($candidate['votes']) }}</p>
                                        <p class="text-xs text-base-content/50">{{ $candidate['percentage'] }}%</p>
                                    </div>
                                </div>

                                <div class="ml-9 pl-4">
                                    <div class="w-full bg-base-300 rounded-full h-2">
                                        <div
                                            class="h-2 rounded-full transition-all duration-500 {{ $candidate['leading'] ? 'bg-success' : 'bg-primary' }}"
                                            style="width: {{ $candidate['percentage'] }}%"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="card bg-base-100 border border-base-300 p-8 text-center text-sm text-base-content/50">
            No elections found. Create one first.
        </div>
    @endif
</div>