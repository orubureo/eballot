<div>
    <div class="min-h-screen flex items-center justify-center px-4 py-10 bg-base-200/40">
        <div class="card bg-white shadow-sm border border-base-300 w-full max-w-3xl">
            <div class="card-body p-6 md:p-10">

                <div class="mb-6">
                    <a href="{{ route('account.dashboard') }}" wire:navigate
                        class="text-sm text-base-content/60 hover:text-primary inline-flex items-center gap-1">
                        <i class="bi bi-arrow-left"></i>
                        Back to dashboard
                    </a>

                    <div class="flex items-center gap-2 mt-3">
                        <span class="badge badge-success badge-sm gap-1">
                            <span class="size-1.5 rounded-full bg-current animate-pulse"></span>
                            Live
                        </span>
                    </div>
                    <h1 class="text-xl font-semibold mt-2">{{ $election->title }}</h1>
                    <p class="text-sm text-base-content/60 mt-1 flex items-center gap-1">
                        <i class="bi bi-exclamation-triangle text-warning"></i>
                        Select one candidate to cast your vote. This action cannot be undone.
                    </p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-8">
                    @foreach ($candidates as $candidate)
                                    <button wire:click="$set('selectedCandidate', {{ $candidate->id }})" class="card border-2 transition-all duration-150 cursor-pointer text-left relative
                                                                                {{ $selectedCandidate === $candidate->id
                        ? 'border-primary bg-primary/5 shadow-md'
                        : 'border-base-300 bg-base-100 hover:border-primary/40 hover:shadow-sm' }}">

                                        @if ($selectedCandidate === $candidate->id)
                                            <span
                                                class="absolute top-2 right-2 flex items-center justify-center size-5 rounded-full bg-primary text-primary-content">
                                                <i class="bi bi-check-lg text-xs"></i>
                                            </span>
                                        @endif

                                        <div class="card-body items-center text-center p-4">
                                            @if ($candidate->photo)
                                                <img src="{{ asset('storage/' . $candidate->photo) }}"
                                                    class="size-20 rounded-full object-cover mb-2 ring-2 {{ $selectedCandidate === $candidate->id ? 'ring-primary' : 'ring-transparent' }}"
                                                    alt="{{ $candidate->full_name }}" />
                                            @else
                                                <div
                                                    class="size-20 rounded-full bg-base-300 flex items-center justify-center text-2xl font-semibold mb-2 ring-2 {{ $selectedCandidate === $candidate->id ? 'ring-primary' : 'ring-transparent' }}">
                                                    {{ strtoupper(substr($candidate->full_name, 0, 1)) }}
                                                </div>
                                            @endif
                                            <p class="font-medium text-sm leading-tight">{{ $candidate->full_name }}</p>
                                            @if ($selectedCandidate === $candidate->id)
                                                <div class="mt-1">
                                                    <span class="badge badge-primary badge-sm gap-1">
                                                        <i class="bi bi-check-circle"></i>
                                                        Selected
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </button>
                    @endforeach
                </div>

                @error('selectedCandidate')
                    <div class="alert alert-error alert-soft mb-4 text-sm">
                        <i class="bi bi-exclamation-circle"></i>
                        <p>{{ $message }}</p>
                    </div>
                @enderror

                <button wire:click="castVote" wire:confirm="Are you sure? Your vote cannot be changed once submitted."
                    class="btn btn-primary w-full gap-2" @if (!$selectedCandidate) disabled @endif>
                    <i class="bi bi-check2-square"></i>
                    Submit vote
                </button>

                <div class="flex gap-2 items-center justify-center mt-4 text-base-content/50">
                    <i class="bi bi-shield-check text-sm"></i>
                    <p class="text-xs">Your vote is secure and anonymous</p>
                </div>

            </div>
        </div>
    </div>
</div>