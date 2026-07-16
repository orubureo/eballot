<div>
    <div class="min-h-screen flex items-center justify-center px-4 py-10 bg-base-200/40">
        <div class="w-full max-w-3xl">

            <a href="{{ route('account.elections.details', $election) }}" wire:navigate
                class="text-sm text-base-content/60 hover:text-primary inline-flex items-center gap-1 mb-4">
                <i class="bi bi-arrow-left"></i>
                Back to Election Details
            </a>

            {{-- Header banner --}}
            <div class="rounded-2xl bg-linear-to-r from-primary/90 to-primary p-6 mb-6 text-primary-content">
                <h1 class="text-xl font-semibold">Cast Your Vote</h1>
                <p class="text-sm text-primary-content/70 mt-1">{{ $election->title }}</p>
            </div>

            {{-- Important instructions --}}
            <div class="alert alert-warning alert-soft mb-6 items-start">
                <i class="bi bi-info-circle mt-0.5"></i>
                <div>
                    <p class="font-medium mb-1">Important Instructions</p>
                    <ul class="text-sm space-y-0.5">
                        <li>Select one candidate by clicking on their card</li>
                        <li>Review your selection carefully before submitting</li>
                        <li>Once submitted, your vote cannot be changed</li>
                        <li>Your vote is anonymous and secure</li>
                    </ul>
                </div>
            </div>

            <h2 class="font-semibold mb-3">Select Your Candidate</h2>

            @error('selectedCandidate')
                <div class="alert alert-error alert-soft mb-4 text-sm">
                    <i class="bi bi-exclamation-circle"></i>
                    <p>{{ $message }}</p>
                </div>
            @enderror

            <div class="flex flex-col gap-3 mb-6">
                @foreach ($candidates as $candidate)
                    <button type="button" wire:click="$set('selectedCandidate', {{ $candidate->id }})"
                        class="card border-2 transition-all duration-150 cursor-pointer text-left bg-white
                                            {{ $selectedCandidate === $candidate->id ? 'border-primary' : 'border-base-300 hover:border-primary/40' }}">
                        <div class="card-body py-4 flex-row items-center gap-4">
                            <input type="radio" class="radio radio-primary shrink-0" {{ $selectedCandidate === $candidate->id ? 'checked' : '' }} readonly />

                            @if ($candidate->photo)
                                <img src="{{ asset('storage/' . $candidate->photo) }}"
                                    class="size-12 rounded-full object-cover shrink-0" alt="{{ $candidate->full_name }}" />
                            @else
                                <div
                                    class="size-12 rounded-full bg-base-300 flex items-center justify-center font-semibold shrink-0">
                                    {{ strtoupper(substr($candidate->full_name, 0, 1)) }}
                                </div>
                            @endif

                            <p class="font-medium flex-1 min-w-0 truncate">{{ $candidate->full_name }}</p>

                            @if ($selectedCandidate === $candidate->id)
                                <span
                                    class="flex items-center justify-center size-6 rounded-full bg-success text-success-content shrink-0">
                                    <i class="bi bi-check-lg text-xs"></i>
                                </span>
                            @endif
                        </div>
                    </button>
                @endforeach
            </div>

            {{-- Cancel / Submit footer --}}
            <div class="flex gap-3">
                <a href="{{ route('account.elections.details', $election) }}" wire:navigate
                    class="btn btn-outline flex-1">Cancel</a>
                <button type="button" x-on:click="
                        if (!$wire.selectedCandidate) {
                            $wire.validateSelection();
                        } else if (confirm('Are you sure? Your vote cannot be changed once submitted.')) {
                            $wire.castVote();
                        }
                    " class="btn btn-primary flex-1 gap-2">
                    <i class="bi bi-check2-square"></i>
                    Submit Vote
                </button>
            </div>

            <div class="flex gap-2 items-center justify-center mt-4 text-base-content/50">
                <i class="bi bi-shield-check text-sm"></i>
                <p class="text-xs">Your vote is secure and anonymous</p>
            </div>

        </div>
    </div>
</div>