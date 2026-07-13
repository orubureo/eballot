<div class="px-2 md:px-5 py-10 md:py-10">
    <div class="flex items-start justify-between gap-4 mb-8 p-4 -mx-4">
        <div>
            <h1 class="text-xl font-semibold">Elections</h1>
            <p class="text-sm text-base-content/60 mt-1">Create and manage all elections</p>
        </div>
        <button wire:click="create" class="btn btn-primary btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            New election
        </button>
    </div>

    <div class="card bg-white rounded-2xl shadow border border-base-300">
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="text-xs font-semibold uppercase tracking-wider text-base-content/40">
                        <th>Election</th>
                        <th>Status</th>
                        <th>Window</th>
                        <th>Candidates</th>
                        <th>Turnout</th>
                        <th class="text-center">Action Buttons</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($elections as $election)
                        <tr class="hover">
                            <td class="font-medium">{{ $election->title }}</td>
                            <td>
                                @php
                                    $badge = match ($election->status) {
                                        'active' => 'badge-success',
                                        'upcoming' => 'badge-warning',
                                        'closed' => 'badge-neutral badge-soft',
                                        default => 'badge-outline',
                                    };
                                @endphp
                                <span class="badge {{ $badge }} badge-sm gap-1">
                                    @if ($election->status === 'active')
                                        <span class="size-1.5 rounded-full bg-current animate-pulse"></span>
                                    @endif
                                    {{ ucfirst($election->status) }}
                                </span>
                            </td>
                            <td class="text-sm text-base-content/70">
                                {{ $election->start_date->format('M j') }} - {{ $election->end_date->format('M j') }}
                            </td>
                            <td class="text-sm">
                                <a href="{{ route('admin.elections.candidates', $election) }}" wire:navigate
                                    class="btn btn-ghost btn-xs">
                                    <i class="bi bi-person-add text-info text-2xl"></i>
                                </a>
                            </td>
                            <td class="text-sm">
                                {{ $eligibleVoters > 0 ? round(($election->votes_count / $eligibleVoters) * 100, 1) . '%' : '—' }}
                            </td>
                            <td class="text-right flex flex-col">
                                <button wire:click="edit({{ $election->id }})" class="btn btn-ghost btn-xs"
                                    title="Manage Election">
                                    <i class="bi bi-pencil-square text-primary text-xl"></i>
                                </button>
                                <button wire:click="delete({{ $election->id }})"
                                    wire:confirm="Delete this election? This cannot be undone."
                                    class="btn btn-ghost btn-xs text-error" title="Delete Election">
                                    <i class="bi bi-trash3 text-error text-xl"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-sm text-base-content/50 py-8">No elections yet. Create
                                your first one.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $elections->links() }}
    </div>

    @if ($showModal)
        <dialog open class="modal">
            <div class="modal-box">
                <h3 class="font-semibold text-lg mb-4">{{ $editingId ? 'Edit election' : 'New election' }}</h3>
                <form wire:submit="save" class="space-y-4">
                    <div>
                        <label class="label"><span class="label-text">Title</span></label>
                        <input type="text" wire:model="title" class="input input-bordered w-full" />
                        @error('title') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="label"><span class="label-text">Description</span></label>
                        <textarea wire:model="description" class="textarea textarea-bordered w-full" rows="3"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="label"><span class="label-text">Starts</span></label>
                            <input type="datetime-local" wire:model="start_date" class="input input-bordered w-full" />
                            @error('start_date') <span class="text-error text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="label"><span class="label-text">Ends</span></label>
                            <input type="datetime-local" wire:model="end_date" class="input input-bordered w-full" />
                            @error('end_date') <span class="text-error text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    {{--
                    <div>
                        <label class="label"><span class="label-text">Status</span></label>
                        <select wire:model="status" class="select select-bordered w-full">
                            <option value="draft">Draft</option>
                            <option value="upcoming">Upcoming</option>
                            <option value="active">Active</option>
                            <option value="closed">Closed</option>
                        </select>
                    </div>
                    --}}
                    <div class="modal-action">
                        <button type="button" wire:click="closeModal" class="btn btn-ghost">Cancel</button>
                        <button type="submit"
                            class="btn btn-primary">{{ $editingId ? 'Save changes' : 'Create election' }}</button>
                    </div>
                </form>
            </div>
            <form method="dialog" class="modal-backdrop" wire:click="closeModal">
                <button>close</button>
            </form>
        </dialog>
    @endif
</div>