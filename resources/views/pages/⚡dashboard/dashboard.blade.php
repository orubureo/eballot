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
    <div class="mb-6 rounded-2xl bg-linear-to-r from-primary/20 via-transparent to-transparent p-4 -mx-4">
        <h1 class="text-xl font-semibold">Welcome, {{ auth()->user()->full_names }}</h1>
        <p class="text-sm text-base-content/60 mt-1">Your voting dashboard</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        {{-- Verification / profile snapshot card --}}
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

        {{-- Verification status banner (kept, moved beside profile card) --}}
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

            {{-- Important Notes card --}}
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

    {{-- Active elections --}}
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-3">
            <span class="flex items-center justify-center size-7 rounded-lg bg-success/10 text-success">
                <i class="bi bi-broadcast text-sm"></i>
            </span>
            <h2 class="font-medium">Active elections</h2>
        </div>

        @if ($activeElections->isEmpty())
            <div class="card bg-white border border-base-300 p-8 text-center">
                <i class="bi bi-calendar-x text-3xl text-base-content/20 mb-2"></i>
                <p class="text-sm text-base-content/50 mb-3">No active elections right now. Check back later.</p>
                @if (!auth()->user()->verified_at)
                    <a href="{{ route('account.verification') }}" wire:navigate
                        class="btn btn-error btn-soft btn-sm gap-1 mx-auto">
                        <i class="bi bi-upload"></i>
                        Upload verification document
                    </a>
                @endif
            </div>
        @else
            <div class="grid gap-4">
                @foreach ($activeElections as $election)
                    <div class="card bg-white border border-base-300 border-l-4 border-l-success" x-data="{
                                                                                endsAt: new Date('{{ $election->end_date->toIso8601String() }}').getTime(),
                                                                                    remaining: '',
                                                                                    tick() {
                                                                                    const diff = this.endsAt - Date.now();
                                                                                    if (diff <= 0) { this.remaining = 'Closed'; return; }
                                                                                    const d = Math.floor(diff / 86400000);
                                                                                    const h = Math.floor((diff % 86400000) / 3600000);
                                                                                    const m = Math.floor((diff % 3600000) / 60000);
                                                                                    const s = Math.floor((diff % 60000) / 1000);
                                                                                    this.remaining = d > 0 ? `${d}d ${h}h ${m}m` : `${h}h ${m}m ${s}s`;                                                                                    }
                                                                                 }"
                        x-init="tick(); setInterval(() => tick(), 1000)">
                        <div class="card-body">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="badge badge-success badge-sm gap-1">
                                            <span class="size-1.5 rounded-full bg-current animate-pulse"></span>
                                            Live
                                        </span>
                                        <span class="badge badge-soft badge-sm gap-1" x-text="remaining"></span>
                                    </div>
                                    <h3 class="font-medium">{{ $election->title }}</h3>
                                    @if ($election->description)
                                        <p class="text-sm text-base-content/60 mt-1">{{ $election->description }}</p>
                                    @endif
                                    <p class="text-xs text-base-content/40 mt-2 flex items-center gap-3">
                                        <span class="flex items-center gap-1">
                                            <i class="bi bi-clock"></i>
                                            Closes {{ $election->end_date->diffForHumans() }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <i class="bi bi-people"></i>
                                            {{ $election->candidates_count }}
                                            candidate{{ $election->candidates_count !== 1 ? 's' : '' }}
                                        </span>
                                    </p>
                                </div>
                                <div class="shrink-0">
                                    @if ($election->user_has_voted)
                                        <span class="badge badge-ghost gap-1">
                                            <i class="bi bi-check-circle"></i>
                                            Voted
                                        </span>
                                    @elseif (!auth()->user()->verified_at)
                                        <span class="badge badge-error badge-soft badge-sm">Pending verification</span>
                                    @else
                                        <a href="{{ route('account.vote', $election) }}" wire:navigate
                                            class="btn btn-primary btn-sm gap-1">
                                            <i class="bi bi-check2-square"></i>
                                            Vote now
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Upcoming elections --}}
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-3">
            <span class="flex items-center justify-center size-7 rounded-lg bg-warning/10 text-warning">
                <i class="bi bi-clock-history text-sm"></i>
            </span>
            <h2 class="font-medium">Upcoming elections</h2>
        </div>

        @if ($upcomingElections->isEmpty())
            <div class="card bg-white border border-base-300 p-6 text-center">
                <p class="text-sm text-base-content/50">No upcoming elections scheduled yet.</p>
            </div>
        @else
            <div class="grid gap-4">
                @foreach ($upcomingElections as $election)
                    <div class="card bg-white border border-base-300 border-l-4 border-l-warning">
                        <div class="card-body">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    <span class="badge badge-warning badge-soft badge-sm mb-1">Upcoming</span>
                                    <h3 class="font-medium">{{ $election->title }}</h3>
                                    @if ($election->description)
                                        <p class="text-sm text-base-content/60 mt-1">{{ $election->description }}</p>
                                    @endif
                                    <p class="text-xs text-base-content/40 mt-2 flex items-center gap-1">
                                        <i class="bi bi-calendar3"></i>
                                        Opens {{ $election->start_date->diffForHumans() }}
                                        ({{ $election->start_date->format('M j, g:ia') }})
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Past votes --}}
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
                                        · Voted for <span
                                            class="font-medium text-base-content/70">{{ $election->your_candidate }}</span>
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
</div>