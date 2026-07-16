<div>
    <div class="px-2 md:px-5 py-10 md:py-10">
        <a href="{{ route('account.elections') }}" wire:navigate
            class="text-sm text-base-content/60 hover:text-primary inline-flex items-center gap-1 mb-4">
            <i class="bi bi-arrow-left"></i>
            Back to elections
        </a>

        <div class="flex items-center justify-between gap-4 mb-6">
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="text-xl font-semibold">{{ $election->title }}</h1>
                    @if ($election->status === 'active')
                        <span class="badge badge-success badge-sm gap-1">
                            <span class="size-1.5 rounded-full bg-current animate-pulse"></span>
                            Live
                        </span>
                    @endif
                </div>
                <p class="text-sm text-base-content/60 mt-1">Live vote counts per candidate</p>
            </div>
        </div>

        {{-- Your vote banner --}}
        @if ($yourCandidate)
            <div role="alert" class="alert alert-success alert-soft mb-6">
                <i class="bi bi-check-circle-fill text-lg"></i>
                <p>You voted for <span class="font-semibold">{{ $yourCandidate }}</span></p>
            </div>
        @endif

        {{-- Stat cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="card bg-white border border-base-300">
                <div class="card-body p-4 gap-1">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-base-content/50">Total votes</span>
                        <span class="flex items-center justify-center size-8 rounded-lg bg-primary/10 text-primary">
                            <i class="bi bi-people text-base"></i>
                        </span>
                    </div>
                    <div class="text-2xl font-semibold">{{ number_format($totalVotes) }}</div>
                </div>
            </div>
            <div class="card bg-white border border-base-300">
                <div class="card-body p-4 gap-1">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-base-content/50">Candidates</span>
                        <span class="flex items-center justify-center size-8 rounded-lg bg-info/10 text-info">
                            <i class="bi bi-person-badge text-base"></i>
                        </span>
                    </div>
                    <div class="text-2xl font-semibold">{{ $candidates->count() }}</div>
                </div>
            </div>
            <div class="card bg-white border border-base-300">
                <div class="card-body p-4 gap-1">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-base-content/50">Status</span>
                        <span class="flex items-center justify-center size-8 rounded-lg bg-success/10 text-success">
                            <i class="bi bi-broadcast text-base"></i>
                        </span>
                    </div>
                    <div class="text-2xl font-semibold capitalize">{{ $election->status }}</div>
                </div>
            </div>
            <div class="card bg-white border border-base-300">
                <div class="card-body p-4 gap-1">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-base-content/50">Closes</span>
                        <span class="flex items-center justify-center size-8 rounded-lg bg-warning/10 text-warning">
                            <i class="bi bi-calendar3 text-base"></i>
                        </span>
                    </div>
                    <div class="text-lg font-semibold">{{ $election->end_date->format('M j, Y') }}</div>
                </div>
            </div>
        </div>

        @if ($candidates->isEmpty())
            <div class="card bg-white rounded-2xl border border-base-300 p-8 text-center text-sm text-base-content/50">
                No candidates added to this election yet.
            </div>
        @else
            {{-- Current leader spotlight --}}
            @php $leader = $candidates->firstWhere('leading', true) ?? $candidates->first(); @endphp
            @if ($leader && $totalVotes > 0)
                <div class="card bg-white border border-base-300 mb-6">
                    <div class="card-body">
                        <div class="flex items-center gap-2 mb-3 text-base-content/60">
                            <i class="bi bi-trophy-fill text-warning"></i>
                            <span class="text-sm font-medium">Current leader</span>
                        </div>
                        <div class="flex items-center justify-between gap-4 bg-success/5 border border-success/20 rounded-xl p-4">
                            <div class="flex items-center gap-3 min-w-0">
                                @if ($leader['photo'])
                                    <img src="{{ asset('storage/' . $leader['photo']) }}" class="size-12 rounded-full object-cover" />
                                @else
                                    <div class="size-12 rounded-full bg-base-300 flex items-center justify-center font-semibold">
                                        {{ strtoupper(substr($leader['full_name'], 0, 1)) }}
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <p class="font-medium truncate">{{ $leader['full_name'] }}</p>
                                    <p class="text-xs text-base-content/50">{{ number_format($leader['votes']) }} votes</p>
                                </div>
                            </div>
                            <p class="text-2xl font-semibold text-success shrink-0">{{ $leader['percentage'] }}%</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Data island for charts --}}
            <div id="results-chart-data"
                data-labels='@json($candidates->pluck("full_name"))'
                data-votes='@json($candidates->pluck("votes"))'
                class="hidden"></div>

            {{-- Charts --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6" x-data="resultsCharts()" x-init="init()">
                <div class="card bg-white border border-base-300">
                    <div class="card-body">
                        <h3 class="font-medium mb-3">Vote distribution</h3>
                        <div wire:ignore class="h-64">
                            <canvas x-ref="barCanvas"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card bg-white border border-base-300">
                    <div class="card-body">
                        <h3 class="font-medium mb-3">Vote share</h3>
                        <div wire:ignore class="h-64">
                            <canvas x-ref="pieCanvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Detailed results --}}
            <div class="card bg-white shadow border border-base-300" @if ($election->status === 'active') wire:poll.5000ms="$refresh" @endif>
                <div class="card-body p-0">
                    <div class="px-5 py-4 border-b border-base-300 flex items-center justify-between">
                        <h2 class="font-medium">Detailed results</h2>
                        @if ($election->status === 'active')
                            <span class="text-xs text-base-content/40">Auto-refreshing</span>
                        @endif
                    </div>

                    <div class="divide-y divide-base-300">
                        @foreach ($candidates as $index => $candidate)
                            <div class="px-5 py-4">
                                <div class="flex items-center gap-4 mb-2">
                                    <span class="text-sm font-medium text-base-content/40 w-5">#{{ $index + 1 }}</span>

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
                                            @if ($candidate['full_name'] === $yourCandidate)
                                                <span class="badge badge-primary badge-sm">Your vote</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="text-right shrink-0">
                                        <p class="font-semibold {{ $candidate['leading'] ? 'text-success' : '' }}">{{ $candidate['percentage'] }}%</p>
                                        <p class="text-xs text-base-content/50">{{ number_format($candidate['votes']) }} votes</p>
                                    </div>
                                </div>

                                <div class="ml-9 pl-4">
                                    <div class="w-full bg-base-300 rounded-full h-2">
                                        <div class="h-2 rounded-full transition-all duration-500 {{ $candidate['leading'] ? 'bg-success' : 'bg-primary' }}"
                                            style="width: {{ $candidate['percentage'] }}%"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>