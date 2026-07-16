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

        <div class="bg-base-100 p-10 rounded-xl w-full md:w-[800px] space-y-4">

            <div class="flex flex-col gap-y-4 items-center">

                <span class="badge badge-primary badge-soft px-3 py-1 rounded-full">
                    Account Login
                </span>

                <h1 class="text-xl md:text-2xl text-center">Welcome back, sign into your account!</h1>

            </div>
            <!-- <div>Welcome back, sign in to your account!</div> -->

            @if (session('feedback'))
                <div role="alert" id="feedback-alert" class="alert alert-{{ session('feedback')['type'] }} alert-soft mb-4">
                    {{ session('feedback')['message'] }}
                </div>
            @endif

            <form wire:submit="login" class="flex flex-col gap-4">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <fieldset class="fieldset">

                        <label class="label">Email</label>
                        <input type="email" wire:model="email" class="input w-full" placeholder="Example@mail.com" />
                        @error('email')
                            <span class="text-error text-xs">{{ $message }}</span>
                        @enderror
                    </fieldset>

                    <fieldset class="fieldset">

                        <label class="label">Password</label>
                        <input type="password" wire:model="password" autocomplete="new-password" class="input w-full"
                            placeholder="***********" />
                        @error('password')
                            <span class="text-error text-xs">{{ $message }}</span>
                        @enderror
                    </fieldset>
                </div>

                <button class="btn btn-neutral w-full mt-4">
                    <span wire:loading wire:target="login">Loading...</span>
                    <span wire:loading.remove>Login</span>
                </button>

            </form>
        </div>
    </div>
</div>