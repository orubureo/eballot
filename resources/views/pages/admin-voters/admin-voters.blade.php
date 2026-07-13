<div class="px-2 md:px-5 py-10 md:py-10">
    <div class="flex items-start justify-between gap-4 mb-8 p-4 -mx-4">
        <div>
            <h1 class="text-xl font-semibold">Voters</h1>
            <p class="text-sm text-base-content/60 mt-1">Review submitted documents and verify voter eligibility</p>
        </div>
        <input type="search" wire:model.live.debounce.400ms="search" placeholder="Search name or email"
            class="input input-bordered input-sm w-64" />
    </div>

    <div role="tablist" class="tabs tabs-boxed w-fit mb-4">
        <a role="tab" wire:click="$set('filter', 'all')" class="tab {{ $filter === 'all' ? 'tab-active' : '' }}">
            All
        </a>
        <a role="tab" wire:click="$set('filter', 'verified')"
            class="tab {{ $filter === 'verified' ? 'tab-active' : '' }}">
            Verified <span class="badge badge-sm ml-1">{{ $verifiedCount }}</span>
        </a>
        <a role="tab" wire:click="$set('filter', 'pending')"
            class="tab {{ $filter === 'pending' ? 'tab-active' : '' }}">
            Pending <span class="badge badge-sm ml-1">{{ $pendingCount }}</span>
        </a>
    </div>

    <div class="card bg-white border border-base-300 rounded-2xl shadow">
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="text-xs font-semibold uppercase tracking-wider text-base-content/40">
                        <th>Voter</th>
                        <th>Document</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($voters as $voter)
                        <tr class="hover">
                            <td>
                                <p class="font-medium">{{ $voter['full_names'] }}</p>
                                <p class="text-xs text-base-content/50">{{ $voter['email'] }}</p>
                            </td>
                            <td>
                                <a href="{{ asset('storage/' . $voter['document']) }}" target="_blank"
                                    class="link link-success text-sm">
                                    {{ $voter['document_type'] === 'nin' ? 'View NIN' : "View voter's card" }}
                                </a>
                            </td>
                            <td>
                                @if ($voter['verified_at'])
                                    <span class="badge badge-soft badge-primary badge-sm">Verified</span>
                                @else
                                    <span class="badge badge-soft badge-warning badge-sm">Pending</span>
                                @endif
                            </td>
                            <td class="text-right">
                                @if ($voter['verified_at'])
                                    <button wire:click="unverify({{ $voter['id'] }})"
                                        class="btn btn-ghost btn-xs text-error">Unverify</button>
                                @else
                                    <button wire:click="verify({{ $voter['id'] }})"
                                        class="btn btn-success btn-xs">Verify</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-sm text-base-content/50 py-8">No pending verification.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>