<div class="px-2 md:px-5 py-10 md:py-10">
    {{-- Header --}}
    <div class="flex items-start justify-between gap-4 mb-8 p-4 -mx-4">
        <div>
            <h1 class="text-xl font-semibold">Welcome back, {{ auth()->user()->full_names }}</h1>
            <p class="text-sm text-base-content/60 mt-1">Here's what's happening across your elections</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.elections') }}" wire:navigate class="btn btn-primary btn-sm">View Elections</a>
        </div>
    </div>

    {{-- Stat cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6" wire:poll.10s="refreshStats">

        {{-- Elections --}}
        <div class="card bg-white border border-base-300 shadow-lg rounded-2xl">
            <div class="card-body p-4 gap-1">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-400 font-medium tracking-wide">Elections</span>
                    <span class="flex items-center justify-center size-8 rounded-lg bg-error/10 text-error">
                        <i class="bi bi-calendar3 text-base"></i>
                    </span>
                </div>
                <div class="text-2xl font-semibold">{{ number_format($totalElections) }}</div>
            </div>
        </div>

        {{-- Active elections --}}
        <div class="card bg-white border border-base-300 shadow-lg rounded-2xl">
            <div class="card-body p-4 gap-1">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-400 font-medium tracking-wide">Active elections</span>
                    <span class="flex items-center justify-center size-8 rounded-lg bg-success/10 text-success">
                        <i class="bi bi-clock-history text-base"></i>
                    </span>
                </div>
                <div class="text-2xl font-semibold">{{ number_format($activeElections) }}</div>
            </div>
        </div>

        {{-- Registered voters --}}
        <div class="card bg-white border border-base-300 shadow-lg rounded-2xl">
            <div class="card-body p-4 gap-1">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-400 font-medium tracking-wide">Registered voters</span>
                    <span class="flex items-center justify-center size-8 rounded-lg bg-info/10 text-info">
                        <i class="bi bi-people text-base"></i>
                    </span>
                </div>
                <div class="text-2xl font-semibold">{{ number_format($registeredVoters) }}</div>
            </div>
        </div>

        {{-- Votes cast --}}
        <div class="card bg-white border border-base-300 shadow-lg rounded-2xl">
            <div class="card-body p-4 gap-1">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-400 font-medium tracking-wide">Votes cast</span>
                    <span class="flex items-center justify-center size-8 rounded-lg bg-warning/10 text-warning">
                        <i class="bi bi-check-circle text-base"></i>
                    </span>
                </div>
                <div class="text-2xl font-semibold">{{ number_format($votesCast) }}</div>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Elections table --}}
        <div class="bg-white lg:col-span-2 card border border-base-300 rounded-2xl shadow">
            <div class="card-body p-0">
                <div class="flex items-center justify-between px-5 py-4 border-b border-base-300">
                    <h2 class="font-bold text-lg">Elections</h2>
                    <a href="{{ route('admin.elections') }}" wire:navigate
                        class="link link-primary text-sm no-underline font-medium">View all &rarr;</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr class="text-xs font-semibold uppercase tracking-wider text-base-content/40">
                                <th>Election</th>
                                <th>Status</th>
                                <th>Window</th>
                                <th class="text-right">Turnout</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($elections as $election)
                                <tr class="hover">
                                    <td>
                                        <p class="font-medium">{{ $election['title'] }}</p>
                                        <p class="text-xs text-base-content/50">{{ $election['candidates'] }} candidates</p>
                                    </td>
                                    <td>
                                        @php
                                            $badge = match ($election['status']) {
                                                'active' => 'badge-success',
                                                'upcoming' => 'badge-warning',
                                                'closed' => 'badge-neutral badge-soft',
                                                default => 'badge-outline',
                                            };
                                        @endphp
                                        <span class="badge {{ $badge }} badge-sm gap-1">
                                            @if ($election['status'] === 'active')
                                                <span class="size-1.5 rounded-full bg-current animate-pulse"></span>
                                            @endif
                                            {{ ucfirst($election['status']) }}
                                        </span>
                                    </td>
                                    <td class="text-sm text-base-content/70">{{ $election['window'] }}</td>
                                    <td class="text-right">
                                        @if ($election['turnout'] !== null)
                                            <div class="flex items-center justify-end gap-2">
                                                <progress class="progress progress-warning w-16"
                                                    value="{{ $election['turnout'] }}" max="100"></progress>
                                                <span class="text-xs w-9 text-right">{{ $election['turnout'] }}%</span>
                                            </div>
                                        @else
                                            <span class="text-sm text-base-content/40">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-sm text-base-content/50 py-8">
                                        No elections yet.
                                        <a href="{{ route('admin.elections.create') }}" wire:navigate
                                            class="link link-primary">Create one</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Recent activity --}}
        <div class="card bg-white border border-base-300 rounded-2xl shadow">
            <div class="card-body p-0">
                <div class="px-5 py-4 border-b border-base-300">
                    <h2 class="font-medium">Recent Activity</h2>
                </div>
                <ul class="px-5 py-4 space-y-4">
                    @forelse ($recentActivity as $activity)
                        <li class="flex gap-3">
                            <span
                                class="flex items-center justify-center size-8 rounded-full shrink-0
                                                                                                                                            {{ str_contains($activity['message'], 'was created') ? 'bg-primary/10 text-primary' : (str_contains($activity['message'], 'verified') ? 'bg-info/10 text-info' : 'bg-warning/10 text-warning') }}">
                                <i
                                    class="bi {{ str_contains($activity['message'], 'was created') ? 'bi-calendar-plus' : (str_contains($activity['message'], 'verified') ? 'bi-person-check' : 'bi-check-circle') }} text-sm"></i>
                            </span>
                            <div class="min-w-0">
                                <p class="text-sm leading-snug">{{ $activity['message'] }}</p>
                                <p class="text-xs text-base-content/50">{{ $activity['time'] }}</p>
                            </div>
                        </li>
                    @empty
                        <li class="text-sm text-base-content/50 text-center py-4">No recent activity</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>