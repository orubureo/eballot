<div>
    <div class="relative min-h-screen flex flex-col md:flex-row justify-center items-center gap-12 px-8 py-24 md:px-16 md:py-12 overflow-hidden"
        style="background: linear-gradient(135deg, oklch(0.52 0.08 176.23) 0%, oklch(0.39 0.07 217.51) 100%);">

        <div class="absolute inset-0 opacity-10"
            style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 32px 32px;">
        </div>
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full opacity-20 blur-3xl"
            style="background: oklch(0.98 0.03 161.89);">
        </div>
        <div class="absolute bottom-0 left-0 w-72 h-72 rounded-full opacity-20 blur-3xl"
            style="background: oklch(0.81 0.02 196.7);">
        </div>

        <div class="bg-white p-10 rounded-xl w-full max-w-[900px] mx-4">

            <div class="flex flex-col gap-y-4 items-center mb-4">
                <span class="badge badge-primary badge-soft px-3 py-1 rounded-full">
                    Account Registration
                </span>
                <h1 class="text-xl md:text-2xl text-center">Create an account!</h1>
            </div>

            @if (session('feedback'))
                <div role="alert" id="feedback-alert" class="alert alert-{{ session('feedback')['type'] }} alert-soft mb-4">
                    {{ session('feedback')['message'] }}
                </div>
            @endif

            <form wire:submit="createAccount" class="flex flex-col gap-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <fieldset class="fieldset">
                        <label class="label">Fullname</label>
                        <input type="text" wire:model="full_names" class="input w-full" placeholder="John Doe" />
                        @error('full_names') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </fieldset>
                    <fieldset class="fieldset">
                        <label class="label">Email</label>
                        <input type="email" wire:model="email" autocomplete="off" class="input w-full"
                            placeholder="Example@mail.com" />
                        @error('email') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </fieldset>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
                    <fieldset class="fieldset">
                        <label class="label">Phone Number</label>
                        <input type="tel" wire:model="phone_number" class="input w-full"
                            placeholder="+234 9876543210" />
                        @error('phone_number') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </fieldset>
                    <fieldset class="fieldset">
                        <label class="label">Gender</label>
                        <div class="flex gap-4 items-center">
                            <input type="radio" class="radio" wire:model="gender" name="gender" value="male" /> Male
                            <input type="radio" class="radio" wire:model="gender" name="gender" value="female" /> Female
                        </div>
                        @error('gender') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </fieldset>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <fieldset class="fieldset">
                        <label class="label">Document Type</label>
                        <div class="flex gap-4 items-center">
                            <input type="radio" class="radio" wire:model="document_type" name="document_type"
                                value="nin" /> NIN
                            <input type="radio" class="radio" wire:model="document_type" name="document_type"
                                value="voters_card" /> Voter's Card
                        </div>
                        @error('document_type') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </fieldset>
                    <fieldset class="fieldset">
                        <label class="label">Upload Document</label>
                        <input type="file" wire:model="document" class="file-input file-input-bordered w-full" />
                        <p wire:loading wire:target="document" class="label text-info">Uploading...</p>
                        @error('document') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </fieldset>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <fieldset class="fieldset">
                        <label class="label">Password</label>
                        <input type="password" wire:model="password" autocomplete="new-password" class="input w-full"
                            placeholder="Password" />
                        @error('password') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </fieldset>
                    <fieldset class="fieldset">
                        <label class="label">Confirm Password</label>
                        <input type="password" wire:model="password_confirmation" class="input w-full"
                            placeholder="Confirm Password" />
                        @error('password_confirmation') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </fieldset>
                </div>

                <button class="btn btn-neutral mt-4">
                    <span>Register</span>
                    <span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </span>
                </button>
            </form>
        </div>
    </div>
</div>