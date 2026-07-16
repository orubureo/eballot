<div class="px-2 md:px-5 py-10 md:py-10">
    @if (session('success'))
        <div role="alert" class="alert alert-success mb-4">
            <i class="bi bi-check-circle-fill text-lg"></i>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if (session('error'))
        <div role="alert" class="alert alert-error mb-4">
            <i class="bi bi-exclamation-circle-fill text-lg"></i>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    {{-- Welcome header --}}
    <div class="mb-6 rounded-2xl p-4 -mx-4">
        <h1 class="text-xl font-semibold">Welcome, {{ auth()->user()->full_names }}</h1>
        <p class="text-sm text-base-content/60 mt-1">Your voting dashboard</p>
    </div>
    {{--
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Verification / profile snapshot card -->
        <div class="lg:col-span-1 card bg-white border border-base-300">
            <div class="card-body gap-3">
                <div class="flex items-center gap-3">
                    <span class="flex items-center justify-center size-12 rounded-full
                    {{ auth()->user()->verified_at ? 'bg-success/10 text-success' : 'bg-error/10 text-error' }}">
                        <i
                            class="bi {{ auth()->user()->verified_at ? 'bi-patch-check-fill' : 'bi-hourglass-split' }} text-xl"></i>
                    </span>
                    <div>
                        <p class="font-medium">{{ auth()->user()->full_names }}</p>
                        <span
                            class="badge badge-sm gap-1 {{ auth()->user()->verified_at ? 'badge-success badge-soft' : 'badge-error badge-soft' }}">
                            {{ auth()->user()->verified_at ? 'Verified' : 'Pending verification' }}
                        </span>
                    </div>
                </div>

                <div class="divider my-0"></div>

                <div class="space-y-2 text-sm">
                    <div class="flex items-center justify-between text-base-content/60">
                        <span class="flex items-center gap-1"><i class="bi bi-envelope"></i> Email</span>
                        <span class="text-base-content/80">{{ auth()->user()->email }}</span>
                    </div>
                    <div class="flex items-center justify-between text-base-content/60">
                        <span class="flex items-center gap-1"><i class="bi bi-file-earmark-text"></i> Document</span>
                        <span class="text-base-content/80">{{ auth()->user()->document_type ?? '—' }}</span>
                    </div>
                    <div class="flex items-center justify-between text-base-content/60">
                        <span class="flex items-center gap-1"><i class="bi bi-calendar3"></i> Registered</span>
                        <span class="text-base-content/80">{{ auth()->user()->created_at->format('M j, Y') }}</span>
                    </div>
                </div>

                @if (!auth()->user()->verified_at)
                <div class="alert alert-warning alert-soft mt-2 text-xs">
                    <i class="bi bi-info-circle"></i>
                    <span>An admin is reviewing your document. You'll be notified once verified.</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Verification status banner (kept, moved beside profile card)  -->
        <div class="lg:col-span-2 flex flex-col gap-4">
            @if (!auth()->user()->verified_at)
            <div role="alert" class="alert alert-error alert-soft">
                <span class="flex items-center justify-center size-9 rounded-full bg-error/10 text-error shrink-0">
                    <i class="bi bi-hourglass-split text-lg"></i>
                </span>
                <div>
                    <p class="font-medium">Your account is pending verification</p>
                    <p class="text-sm">An admin is reviewing your submitted document. You'll be able to vote once
                        verified.</p>
                </div>
            </div>
            @else
            <div role="alert" class="alert alert-success alert-soft">
                <span class="flex items-center justify-center size-9 rounded-full bg-success/10 text-success shrink-0">
                    <i class="bi bi-patch-check-fill text-lg"></i>
                </span>
                <p class="font-medium">Your account is verified — you can vote in active elections</p>
            </div>
            @endif

            <!-- Important Notes card  -->
            <div class="card bg-white border border-base-300">
                <div class="card-body gap-3">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="flex items-center justify-center size-7 rounded-lg bg-info/10 text-info">
                            <i class="bi bi-info-circle text-sm"></i>
                        </span>
                        <h2 class="font-medium">Important Notes</h2>
                    </div>
                    <ul class="text-sm space-y-1.5 text-base-content/70">
                        <li class="flex items-start gap-2">
                            <i class="bi bi-dot text-lg leading-none"></i>
                            <span>You can vote only once</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="bi bi-dot text-lg leading-none"></i>
                            <span>Your vote is anonymous and confidential</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="bi bi-dot text-lg leading-none"></i>
                            <span>Results will be displayed after voting ends</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="bi bi-dot text-lg leading-none"></i>
                            <span>Contact admin if you face any issues</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    --}}

    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-8">
        <div class="card bg-white">
            <div class="card-body">
                <div class="flex align-center justify-between gap-2">
                    <p class="font-bold text-lg">Active Elections</p>
                    <span class="flex items-center justify-center size-9 rounded-full bg-info/10 text-info shrink-0">
                        <i class="bi bi-calendar-event text-lg"></i>
                    </span>
                </div>
                <p class="font-bold text-4xl text-info">{{ $activeElections->count() }}</p>
                <p class="text-xs text-gray-500">Currently ongoing elections</p>
            </div>
        </div>

        @if (!auth()->user()->verified_at)
            <div class="card bg-white">
                <div class="card-body gap-y-3">
                    <div class="flex align-center justify-between gap-2">
                        <p class="font-bold text-lg">Verification Status</p>
                        <span class="flex items-center justify-center size-9 rounded-full bg-error/10 text-error shrink-0">
                            <i class="bi bi-hourglass-split text-lg text-error"></i>
                        </span>
                    </div>
                    <p class="badge badge-error badge-soft text-xs">Pending Verification</p>
                    <p class="text-xs text-gray-500">Your account is unverified</p>
                </div>
            </div>
        @else
            <div class="card bg-white">
                <div class="card-body gap-y-3">
                    <div class="flex align-center justify-between gap-2">
                        <p class="font-bold text-lg">Verification Status</p>
                        <span
                            class="flex items-center justify-center size-9 rounded-full bg-success/10 text-success shrink-0">
                            <i class="bi bi-patch-check-fill text-lg"></i>
                        </span>
                    </div>
                    <p class="badge badge-success badge-soft text-xs">Verified</p>
                    <p class="text-xs text-gray-500">Your account is verified</p>
                </div>
            </div>
        @endif

        <div class="card bg-white">
            <div class="card-body">
                <div class="flex align-center justify-between gap-2">
                    <p class="font-bold text-lg">Voted Elections</p>
                    <span
                        class="flex items-center justify-center size-9 rounded-full bg-warning/10 text-warning shrink-0">
                        <i class="bi bi-check2-circle text-lg"></i>
                    </span>
                </div>
                <p class="font-bold text-4xl text-warning">{{ $votedElections->count() }}</p>
                <p class="text-xs text-gray-500">Elections you have voted in</p>
            </div>
        </div>
    </div>

    {{-- Recent Elections --}}
    <div class="mb-8">
        <div class="card bg-white border border-base-300">
            <div class="card-body p-0">
                <div class="flex items-center justify-between px-5 py-4 border-b border-base-300">
                    <h2 class="font-medium">Recent Elections</h2>
                    <a href="{{ route('account.elections') }}" wire:navigate
                        class="link link-primary text-sm no-underline">View All</a>
                </div>

                @php
                    $recentElections = $activeElections->concat($upcomingElections)->sortBy('start_date')->take(5);
                @endphp

                @if ($recentElections->isEmpty())
                    <div class="p-8 text-center">
                        <i class="bi bi-calendar-x text-3xl text-base-content/20 mb-2"></i>
                        <p class="text-sm text-base-content/50 mb-3">No elections right now. Check back later.</p>
                        @if (!auth()->user()->verified_at)
                            <a href="{{ route('account.verification') }}" wire:navigate
                                class="btn btn-error btn-soft btn-sm gap-1 mx-auto">
                                <i class="bi bi-upload"></i>
                                Upload verification document
                            </a>
                        @endif
                    </div>
                @else
                    <div class="divide-y divide-base-300">
                        @foreach ($recentElections as $election)
                            <div class="flex items-center justify-between gap-4 px-5 py-4">
                                <div class="flex items-center gap-3 min-w-0">
                                    <span
                                        class="flex items-center justify-center size-10 rounded-lg shrink-0
                                                                                                                                                                                                                                                                                                                                                                                {{ $election->status === 'active' ? 'bg-success/10 text-success' : 'bg-warning/10 text-warning' }}">
                                        <i class="bi bi-people"></i>
                                    </span>
                                    <div class="min-w-0">
                                        <p class="font-medium truncate">{{ $election->title }}</p>
                                        <p class="text-xs text-base-content/50">
                                            {{ $election->start_date->format('M j, Y') }} –
                                            {{ $election->end_date->format('M j, Y') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 shrink-0">
                                    <span
                                        class="badge badge-sm gap-1 {{ $election->status === 'active' ? 'badge-success badge-soft' : 'badge-warning badge-soft' }}">
                                        {{ $election->status === 'active' ? 'Ongoing' : 'Upcoming' }}
                                    </span>

                                    @if ($election->status === 'active')
                                        @if (!auth()->user()->verified_at)
                                            <button class="badge badge-sm badge-error">Pending verification</button>
                                        @else
                                            <a href="{{ route('account.elections.details', $election) }}" wire:navigate
                                                class="btn btn-primary btn-sm">View Details
                                            </a>
                                        @endif
                                    @else
                                        <button class="btn btn-sm btn-disabled" disabled>View Details</button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Past votes --}}
    {{--
    <div>
        <div class="flex items-center gap-2 mb-3">
            <span class="flex items-center justify-center size-7 rounded-lg bg-info/10 text-info">
                <i class="bi bi-clock-history text-sm"></i>
            </span>
            <h2 class="font-medium">Your voting history</h2>
        </div>

        @if ($votedElections->isEmpty())
        <div class="card bg-white border border-base-300 p-8 text-center">
            <i class="bi bi-inbox text-3xl text-base-content/20 mb-2"></i>
            <p class="text-sm text-base-content/50">You haven't voted in any elections yet.</p>
        </div>
        @else
        <div class="grid gap-4">
            @foreach ($votedElections as $election)
            <div class="card bg-white border border-base-300 border-l-4 border-l-info">
                <div class="card-body">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="font-medium">{{ $election->title }}</h3>
                            <p class="text-xs text-base-content/40 mt-1 flex items-center gap-1">
                                <i class="bi bi-flag"></i>
                                {{ ucfirst($election->status) }}
                                · Voted for <span class="font-medium text-base-content/70">{{ $election->your_candidate
                                    }}</span>
                            </p>
                        </div>
                        @if ($election->status === 'closed')
                        <a href="{{ route('account.results', $election) }}" wire:navigate
                            class="btn btn-ghost btn-sm shrink-0 gap-1">
                            <i class="bi bi-bar-chart"></i>
                            View results
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    --}}
</div>