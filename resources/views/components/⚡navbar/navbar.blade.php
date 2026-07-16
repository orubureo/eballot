<div x-data="{ open: false }">
    <div class="navbar bg-white shadow-sm px-4 fixed top-0 z-10">
        <div class="navbar-start">
            {{-- Hamburger (mobile only) --}}
            @if (auth()->check())
                <button @click="open = true" class="btn btn-ghost btn-sm lg:hidden mr-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            @endif

            {{-- Logo --}}
            <a href="{{ auth()->check() ? (auth()->user()->is_admin ? route('admin.dashboard') : route('account.dashboard')) : route('home') }}"
                wire:navigate>
                <img src="{{ asset('images/eballot-logo.png') }}" class="h-10" alt="eBallot" />
            </a>
        </div>

        {{-- Desktop nav links --}}
        <div class="navbar-center hidden lg:flex">
            @if (auth()->check() && auth()->user()->is_admin)
                <ul class="menu menu-horizontal gap-1 px-1">
                    <li><a href="{{ route('admin.dashboard') }}" wire:navigate
                            class="{{ request()->routeIs('admin.dashboard') ? 'text-primary font-medium' : '' }}">Dashboard</a>
                    </li>
                    <li><a href="{{ route('admin.elections') }}" wire:navigate
                            class="{{ request()->routeIs('admin.elections') ? 'text-primary font-medium' : '' }}">Elections</a>
                    </li>
                    <li><a href="{{ route('admin.voters') }}" wire:navigate
                            class="{{ request()->routeIs('admin.voters') ? 'text-primary font-medium' : '' }}">Voters</a>
                    </li>
                    <li><a href="{{ route('admin.results') }}" wire:navigate
                            class="{{ request()->routeIs('admin.results') ? 'text-primary font-medium' : '' }}">Results</a>
                    </li>
                </ul>
            @else
                <ul class="menu menu-horizontal gap-1 px-1">
                    <li><a href="{{ route('account.dashboard') }}" wire:navigate
                            class="{{ request()->routeIs('account.dashboard') ? 'text-primary font-medium' : '' }}">Dashboard</a>
                    </li>
                    <li><a href="{{ route('account.elections') }}" wire:navigate
                            class="{{ request()->routeIs('account.elections') ? 'text-primary font-medium' : '' }}">Elections</a>
                    </li>
                    {{-- <li><a href="{{ route('account.results') }}" wire:navigate
                            class="{{ request()->routeIs('account.results') ? 'text-primary font-medium' : '' }}">Results</a>
                    </li> --}}
                </ul>
            @endif
        </div>

        <div class="navbar-end gap-2">
            @if (auth()->check())
                <a href="{{ route('logout') }}" wire:navigate
                    class="btn btn-soft btn-error btn-sm rounded-full hidden lg:flex">
                    <i class="bi bi-box-arrow-in-right text-2xl"></i>
                    Sign Out
                </a>
            @else
                <a href="{{ route('login') }}" wire:navigate class="btn btn-sm btn-ghost">Login</a>
                <a href="{{ route('onboarding') }}" wire:navigate class="btn btn-soft btn-primary btn-sm rounded-full">Get
                    Started</a>
            @endif
        </div>
    </div>

    {{-- Desktop sidebar (authenticated only, lg and up) --}}
    {{--

    @if (auth()->check())
    <aside class="hidden lg:flex lg:flex-col fixed top-0 left-0 h-full w-64 bg-white border-r border-base-300 z-10">
        <div class="flex items-center h-16 px-4 border-b border-base-300">
            <a href="{{ auth()->user()->is_admin ? route('admin.dashboard') : route('account.dashboard') }}"
                wire:navigate>
                <img src="{{ asset('images/eballot-logo.png') }}" class="h-8" alt="eBallot" />
            </a>
        </div>

        <nav class="flex-1 px-3 py-4 overflow-y-auto">
            @if (auth()->user()->is_admin)
            <ul class="menu gap-1 w-full">
                <li><a href="{{ route('admin.dashboard') }}" wire:navigate
                        class="{{ request()->routeIs('admin.dashboard') ? 'bg-primary/10 text-primary font-medium' : '' }}">
                        <i class="bi bi-speedometer2"></i> Dashboard</a></li>
                <li><a href="{{ route('admin.elections') }}" wire:navigate
                        class="{{ request()->routeIs('admin.elections') ? 'bg-primary/10 text-primary font-medium' : '' }}">
                        <i class="bi bi-calendar3"></i> Elections</a></li>
                <li><a href="{{ route('admin.voters') }}" wire:navigate
                        class="{{ request()->routeIs('admin.voters') ? 'bg-primary/10 text-primary font-medium' : '' }}">
                        <i class="bi bi-people"></i> Voters</a></li>
                <li><a href="{{ route('admin.results') }}" wire:navigate
                        class="{{ request()->routeIs('admin.results') ? 'bg-primary/10 text-primary font-medium' : '' }}">
                        <i class="bi bi-bar-chart"></i> Results</a></li>
            </ul>
            @else
            <ul class="menu gap-1 w-full">
                <li><a href="{{ route('account.dashboard') }}" wire:navigate
                        class="{{ request()->routeIs('account.dashboard') ? 'bg-primary/10 text-primary font-medium' : '' }}">
                        <i class="bi bi-speedometer2"></i> Dashboard</a></li>
            </ul>
            @endif
        </nav>

        <div class="px-3 py-4 border-t border-base-300">
            <a href="{{ route('logout') }}" wire:navigate class="btn btn-soft btn-error btn-sm rounded-full w-full">
                <i class="bi bi-box-arrow-in-right"></i> Sign Out
            </a>
        </div>
    </aside>
    @endif
    --}}

    {{-- Mobile sidebar drawer (unchanged) --}}
    @if (auth()->check())
        <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="open = false"
            class="fixed inset-0 bg-black/40 z-40 lg:hidden" style="display: none;"></div>

        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed top-0 left-0 h-full w-64 bg-base-100 z-50 shadow-xl flex flex-col lg:hidden"
            style="display: none;">
            <div class="flex items-center justify-between px-4 h-16 border-b border-base-300">
                <img src="{{ asset('images/eballot-logo.png') }}" class="h-8" alt="eBallot" />
                <button @click="open = false" class="btn btn-ghost btn-sm btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <nav class="flex-1 px-3 py-4 overflow-y-auto">
                @if (auth()->user()->is_admin)
                    <ul class="menu menu-sm gap-1 w-full">
                        <li><a href="{{ route('admin.dashboard') }}" wire:navigate @click="open = false"
                                class="{{ request()->routeIs('admin.dashboard') ? 'bg-primary/10 text-primary font-medium' : '' }}">Dashboard</a>
                        </li>
                        <li><a href="{{ route('admin.elections') }}" wire:navigate @click="open = false"
                                class="{{ request()->routeIs('admin.elections') ? 'bg-primary/10 text-primary font-medium' : '' }}">Elections</a>
                        </li>
                        <li><a href="{{ route('admin.voters') }}" wire:navigate @click="open = false"
                                class="{{ request()->routeIs('admin.voters') ? 'bg-primary/10 text-primary font-medium' : '' }}">Voters</a>
                        </li>
                        <li><a href="{{ route('admin.results') }}" wire:navigate @click="open = false"
                                class="{{ request()->routeIs('admin.results') ? 'bg-primary/10 text-primary font-medium' : '' }}">Results</a>
                        </li>
                    </ul>
                @endif
            </nav>

            <div class="px-3 py-4 border-t border-base-300">
                <a href="{{ route('logout') }}" wire:navigate class="btn btn-soft btn-error btn-sm rounded-full w-full">Sign
                    Out</a>
            </div>
        </div>
    @endif
</div>