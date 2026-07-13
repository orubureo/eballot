<div>
    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('account.dashboard') }}" wire:navigate
                class="text-sm text-base-content/60 hover:text-primary inline-flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back to dashboard
            </a>
            <h1 class="text-xl font-semibold mt-2">{{ $election->title }}</h1>
            <p class="text-sm text-base-content/60 mt-1">
                {{ ucfirst($election->status) }} · {{ $totalVotes }} {{ Str::plural('vote', $totalVotes) }} cast
            </p>
        </div>

        {{-- Your vote banner --}}
        @if ($yourCandidate)
            <div role="alert" class="alert alert-success alert-soft mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p>You voted for <span class="font-semibold">{{ $yourCandidate }}</span></p>
            </div>
        @endif

        {{-- Results --}}
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body p-0">
                <div class="px-5 py-4 border-b border-base-300">
                    <h2 class="font-medium">Results</h2>
                </div>
                <div class="divide-y divide-base-300">
                    @foreach ($candidates as $index => $candidate)
                        <div class="px-5 py-4">
                            <div class="flex items-center gap-4 mb-2">
                                <span class="text-sm font-medium text-base-content/40 w-5">{{ $index + 1 }}</span>

                                @if ($candidate['photo'])
                                    <img src="{{ asset('storage/' . $candidate['photo']) }}"
                                        class="size-9 rounded-full object-cover" />
                                @else
                                    <div
                                        class="size-9 rounded-full bg-base-300 flex items-center justify-center text-xs font-medium">
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
                                    <p class="font-semibold">{{ number_format($candidate['votes']) }}</p>
                                    <p class="text-xs text-base-content/50">{{ $candidate['percentage'] }}%</p>
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
    </div>
</div>