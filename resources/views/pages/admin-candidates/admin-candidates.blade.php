<div class="px-2 md:px-5 py-10 md:py-10">
    <div
        class="flex items-start justify-between gap-4 mb-8 rounded-2xl bg-linear-to-r from-primary/30 via-transparent to-transparent p-4 -mx-4">
        <div>
            <a href="{{ route('admin.elections') }}" wire:navigate
                class="text-sm text-base-content/60 hover:text-primary inline-flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back
            </a>
            <h1 class="text-xl font-semibold mt-1">{{ $election->title }}</h1>
            <p class="text-sm text-base-content/60 mt-1">Manage candidates for this election</p>
        </div>
        <button wire:click="create" class="btn btn-primary btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Add candidate
        </button>
    </div>

    <div class="card bg-base-100 border border-base-300">
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="text-xs font-semibold uppercase tracking-wider text-base-content/40">
                        <th>Candidate</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($candidates as $candidate)
                        <tr class="hover">
                            <td>
                                <div class="flex items-center gap-3">
                                    @if ($candidate->photo)
                                        <img src="{{ asset('storage/' . $candidate->photo) }}"
                                            class="size-8 rounded-full object-cover" alt="{{ $candidate->full_name }}" />
                                    @else
                                        <div
                                            class="size-8 rounded-full bg-base-300 flex items-center justify-center text-xs font-medium">
                                            {{ strtoupper(substr($candidate->full_name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <span class="font-medium">{{ $candidate->full_name }}</span>
                                </div>
                            </td>
                            <td class="text-right">
                                <button wire:click="edit({{ $candidate->id }})" class="btn btn-ghost btn-xs"
                                    title="Edit Candidate">
                                    <i class="bi bi-pencil-square text-xl text-primary"></i>
                                </button>
                                <button wire:click="delete({{ $candidate->id }})" wire:confirm="Remove this candidate?"
                                    class="btn btn-ghost btn-xs text-error" title="Delete Candidate">
                                    <i class="bi bi-trash text-xl"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center text-sm text-base-content/50 py-8">No candidates yet. Add the
                                first one.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($showModal)
        <dialog open class="modal">
            <div class="modal-box">
                <h3 class="font-semibold text-lg mb-4">{{ $editingId ? 'Edit candidate' : 'Add candidate' }}</h3>
                <form wire:submit="save" class="space-y-4">
                    <div>
                        <label class="label"><span class="label-text">Full name</span></label>
                        <input type="text" wire:model="full_name" class="input input-bordered w-full" />
                        @error('full_name') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="label"><span class="label-text">Photo</span></label>
                        @if ($photo)
                            <div class="mb-2 flex items-center gap-3">
                                <img src="{{ $photo->temporaryUrl() }}"
                                    class="size-16 rounded-full object-cover border border-base-300" />
                                <button type="button" wire:click="clearPhoto"
                                    class="btn btn-ghost btn-xs text-error">Remove</button>
                            </div>
                        @elseif ($existingPhoto)
                            <div class="mb-2 flex items-center gap-3">
                                <img src="{{ asset('storage/' . $existingPhoto) }}"
                                    class="size-16 rounded-full object-cover border border-base-300" />
                                <button type="button" wire:click="clearPhoto"
                                    class="btn btn-ghost btn-xs text-error">Remove</button>
                            </div>
                        @endif
                        <input type="file" wire:model="photo" accept="image/*"
                            class="file-input file-input-bordered w-full" />
                        <div wire:loading wire:target="photo" class="text-xs text-base-content/60 mt-1">Uploading…</div>
                        @error('photo') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="modal-action">
                        <button type="button" wire:click="closeModal" class="btn btn-ghost">Cancel</button>
                        <button type="submit"
                            class="btn btn-primary">{{ $editingId ? 'Save changes' : 'Add candidate' }}</button>
                    </div>
                </form>
            </div>
            <form method="dialog" class="modal-backdrop" wire:click="closeModal">
                <button>close</button>
            </form>
        </dialog>
    @endif
</div>