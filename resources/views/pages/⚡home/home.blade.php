<div>
    {{-- Hero --}}
    <div class="relative min-h-screen flex flex-col md:flex-row items-center gap-12 px-8 py-24 md:px-16 md:py-12 overflow-hidden" style="background: linear-gradient(135deg, oklch(0.52 0.08 176.23) 0%, oklch(0.39 0.07 217.51) 100%);">

        <div class="absolute inset-0 opacity-10"
            style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 32px 32px;">
        </div>
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full opacity-20 blur-3xl"
            style="background: oklch(0.98 0.03 161.89);">
        </div>
        <div class="absolute bottom-0 left-0 w-72 h-72 rounded-full opacity-20 blur-3xl"
            style="background: oklch(0.81 0.02 196.7);">
        </div>

        <div class="md:w-1/2 relative">
            <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm border border-white/25 text-white rounded-full px-4 py-2 text-sm mb-6">
                <span class="relative flex size-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                    <span class="relative inline-flex rounded-full size-2 bg-white"></span>
                </span>
                End-to-end verified
            </div>

            <h1 class="text-4xl md:text-5xl font-semibold leading-tight text-white mb-4">
                Secure online voting, <br />
                <span class="text-white/70">made simple</span>
            </h1>

            <p class="text-white/60 max-w-md mb-8">
                Cast your vote from anywhere with confidence. Every ballot is encrypted, verifiable, and tamper-proof from submission to count.
            </p>

            <div class="flex flex-wrap gap-3 mb-12">
                <a href="{{ route('onboarding') }}" wire:navigate
                    class="btn bg-white text-primary rounded-full hover:bg-white/90 border-0">
                    Register to vote
                </a>
                <a href="{{ route('login') }}" wire:navigate
                    class="btn bg-white/10 text-white border border-white/30 rounded-full hover:bg-white/20 backdrop-blur-sm">
                    Sign in
                </a>
            </div>

            <div class="flex gap-8">
                <div>
                    <p class="text-2xl font-semibold text-white">2.4M+</p>
                    <p class="text-sm text-white/50">Votes cast</p>
                </div>
                <div class="w-px bg-white/20"></div>
                <div>
                    <p class="text-2xl font-semibold text-white">99.99%</p>
                    <p class="text-sm text-white/50">Uptime</p>
                </div>
                <div class="w-px bg-white/20"></div>
                <div>
                    <p class="text-2xl font-semibold text-white">128-bit</p>
                    <p class="text-sm text-white/50">Encryption</p>
                </div>
            </div>
        </div>

        <div class="md:w-1/2 flex justify-center relative">
            <div class="absolute size-72 rounded-full blur-3xl opacity-30 bg-white"></div>
            <div class="card w-80 shadow-2xl bg-white/95 backdrop-blur-sm border border-white/50 relative">
                <div class="card-body">
                    <div class="flex justify-between items-center mb-3">
                        <div>
                            <p class="text-xs text-base-content/40 uppercase tracking-wider">Active election</p>
                            <p class="text-sm font-semibold">Presidential 2026</p>
                        </div>
                        <div class="badge badge-success badge-sm gap-1">
                            <span class="size-1.5 rounded-full bg-current animate-pulse"></span>
                            Live
                        </div>
                    </div>
                    <ul class="space-y-2">
                        <li class="flex justify-between items-center bg-base-200 rounded-lg border border-base-300 px-4 py-3 cursor-pointer hover:border-primary/40 transition-colors">
                            <span class="text-sm">Candidate A</span>
                            <input type="radio" name="vote" class="radio radio-primary radio-sm" />
                        </li>
                        <li class="flex justify-between items-center bg-primary text-primary-content rounded-lg px-4 py-3 shadow-md">
                            <span class="text-sm font-medium">Candidate B</span>
                            <div class="flex items-center gap-2">
                                <span class="text-xs opacity-75">Selected</span>
                                <input type="radio" name="vote" class="radio radio-sm" checked />
                            </div>
                        </li>
                        <li class="flex justify-between items-center bg-base-200 border border-base-300 rounded-lg px-4 py-3 cursor-pointer hover:border-primary/40 transition-colors">
                            <span class="text-sm">Candidate C</span>
                            <input type="radio" name="vote" class="radio radio-primary radio-sm" />
                        </li>
                    </ul>
                    <button class="btn btn-primary rounded-full mt-4 w-full shadow-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Submit vote
                    </button>
                    <p class="text-xs text-center text-base-content/40 mt-2">Your vote is encrypted and anonymous</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Trusted by --}}
    <!-- <div class="bg-base-100 px-8 py-12 md:px-16 border-y border-base-300">
        <p class="text-center text-sm text-base-content/40 uppercase tracking-widest mb-8">Trusted by leading organizations</p>
        <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-50">
            <span class="text-xl font-bold tracking-tight">INEC</span>
            <span class="text-xl font-bold tracking-tight">UniAbuja</span>
            <span class="text-xl font-bold tracking-tight">NUT</span>
            <span class="text-xl font-bold tracking-tight">ASUU</span>
            <span class="text-xl font-bold tracking-tight">NLC</span>
            <span class="text-xl font-bold tracking-tight">NBA</span>
        </div>
    </div> -->

    {{-- How it works --}}
    <div class="bg-white px-8 py-20 md:px-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-semibold mb-3">How it works</h2>
            <p class="text-base-content/50 max-w-md mx-auto">Get started in three simple steps. The whole process takes less than five minutes.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mx-auto">
            <div class="flex flex-col items-center text-center bg-white p-5 rounded-xl border border-base-300 shadow">
                <div class="size-14 rounded-full badge badge-soft badge-warning flex items-center justify-center mb-4">
                    <span class="text-xl font-semibold">1</span>
                </div>
                <h3 class="font-medium mb-2">Register</h3>
                <p class="text-sm text-base-content/50">Create your account and upload a valid ID document for verification.</p>
            </div>
            <div class="flex flex-col items-center text-center bg-white p-5 rounded-xl border border-base-300 shadow">
                <div class="size-14 badge badge-soft rounded-full badge-error flex items-center justify-center mb-4">
                    <span class="text-xl font-semibold">2</span>
                </div>
                <h3 class="font-medium mb-2">Get verified</h3>
                <p class="text-sm text-base-content/50">Our team reviews your document and approves your voter status within 24 hours.</p>
            </div>
            <div class="flex flex-col items-center text-center bg-white p-5 rounded-xl border border-base-300 shadow">
                <div class="size-14 rounded-full badge badge-soft badge-info flex items-center justify-center mb-4">
                    <span class="text-xl font-semibold">3</span>
                </div>
                <h3 class="font-medium mb-2">Cast your vote</h3>
                <p class="text-sm text-base-content/50">Browse active elections, select your candidate, and submit your encrypted ballot.</p>
            </div>
        </div>
    </div>

    {{-- Live elections --}}
    <div class="px-8 py-20 md:px-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-semibold mb-3">Live elections</h2>
            <p class="text-base-content/50 max-w-md mx-auto">Elections currently open for voting. Register and get verified to participate.</p>
        </div>
        @php $liveElections = \App\Models\Election::where('status', 'active')->withCount('candidates')->latest()->take(3)->get(); @endphp
        @if ($liveElections->isEmpty())
            <div class="text-center text-sm text-base-content/40 py-8">No active elections right now. Check back soon.</div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 max-w-5xl mx-auto">
                @foreach ($liveElections as $election)
                    <div class="card bg-white shadow-md rounded-2xl border border-base-300">
                        <div class="card-body">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="badge badge-success badge-sm gap-1">
                                    <span class="size-1.5 rounded-full bg-current animate-pulse"></span>
                                    Live
                                </span>
                            </div>
                            <h3 class="font-medium">{{ $election->title }}</h3>
                            <p class="text-xs text-base-content/40 mt-1">
                                {{ $election->candidates_count }} candidates · Closes {{ $election->end_date->diffForHumans() }}
                            </p>
                            <div class="card-actions mt-4">
                                <a href="{{ route('onboarding') }}" wire:navigate class="btn btn-primary btn-sm rounded-full w-full">Vote now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Features --}}
    <div class="bg-white px-8 py-20 md:px-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-semibold mb-3">Built for trust</h2>
            <p class="text-base-content/50 max-w-md mx-auto">Every part of eBallot is designed around security, transparency, and accessibility.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mx-auto">
            <div class="bg-white rounded-xl p-6 border border-base-300 shadow duration-300">
                <div class="size-10 rounded-lg bg-warning/10 flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 11-12 0 6 6 0 0112 0zM12 12.75a4.5 4.5 0 00-4.5 4.5h9a4.5 4.5 0 00-4.5-4.5z" />
                    </svg>
                </div>
                <p class="font-medium mb-1">Identity verified</p>
                <p class="text-sm text-base-content/50">Document checks ensure only eligible voters can participate in each election.</p>
            </div>
            <div class="bg-white rounded-xl p-6 border border-base-300 shadow duration-300">
                <div class="size-10 rounded-lg bg-success/10 flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </div>
                <p class="font-medium mb-1">Anonymous by design</p>
                <p class="text-sm text-base-content/50">Your identity and your ballot are never linked. Complete voter privacy is guaranteed.</p>
            </div>
            <div class="bg-white rounded-xl p-6 border border-base-300 shadow duration-300">
                <div class="size-10 rounded-lg bg-info/10 flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-info" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                    </svg>
                </div>
                <p class="font-medium mb-1">Real-time results</p>
                <p class="text-sm text-base-content/50">Watch tallies update live as votes come in. Full transparency from start to finish.</p>
            </div>
            <div class="bg-white rounded-xl p-6 border border-base-300 shadow duration-300">
                <div class="size-10 rounded-lg bg-error/10 flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                </div>
                <p class="font-medium mb-1">One vote per person</p>
                <p class="text-sm text-base-content/50">Duplicate vote prevention is enforced at the database level — not just the UI.</p>
            </div>
            <div class="bg-white rounded-xl p-6 border border-base-300 shadow duration-300">
                <div class="size-10 rounded-lg bg-primary/10 flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 8.25h3m-3 3.75h3m-3 3.75h3" />
                    </svg>
                </div>
                <p class="font-medium mb-1">Audit trail</p>
                <p class="text-sm text-base-content/50">Every action is logged. Full election audit history available to administrators.</p>
            </div>
            <div class="bg-white rounded-xl p-6 border border-base-300 shadow duration-300">
                <div class="size-10 rounded-lg bg-secondary/10 flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                    </svg>
                </div>
                <p class="font-medium mb-1">Smart timing</p>
                <p class="text-sm text-base-content/50">Elections open and close automatically based on the schedule set by the administrator.</p>
            </div>
        </div>
    </div>

    {{-- Security deep-dive --}}
    <div class="bg-white px-8 py-20 md:px-16">
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-semibold mb-4">Security you can rely on</h2>
                <p class="text-base-content/50 mb-8">eBallot is built on battle-tested security principles used by financial institutions and government systems worldwide.</p>
                <ul class="space-y-4">
                    @foreach ([
                        ['128-bit AES encryption', 'All ballots are encrypted end-to-end before leaving your device.'],
                        ['Document verification', 'NIN and voter\'s card checks prevent fake or duplicate registrations.'],
                        ['Session timeout', 'Inactive sessions are automatically terminated to prevent unauthorized access.'],
                        ['Database-level constraints', 'Unique vote constraints enforced at the database level, not just application code.'],
                    ] as [$title, $desc])
                        <li class="flex items-start gap-3">
                            <div class="size-6 rounded-full bg-success/10 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-sm">{{ $title }}</p>
                                <p class="text-xs text-base-content/50">{{ $desc }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="bg-white rounded-2xl border border-base-300 p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="size-10 rounded-full bg-success/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-sm">Your vote is safe</p>
                        <p class="text-xs text-base-content/40">Security audit passed · July 2026</p>
                    </div>
                </div>
                <div class="space-y-3">
                    @foreach (['Ballot encryption', 'Identity checks', 'Duplicate prevention', 'Audit logging', 'Data protection'] as $check)
                        <div class="flex items-center justify-between py-2 border-b border-base-300 last:border-0">
                            <span class="text-sm">{{ $check }}</span>
                            <span class="badge badge-success badge-sm">Passed</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- CTA --}}
    <div class="bg-primary px-8 py-20 md:px-16 text-center">
        <h2 class="text-3xl font-semibold text-primary-content mb-3">Ready to make your voice heard?</h2>
        <p class="text-primary-content/70 max-w-md mx-auto mb-8">Join thousands of verified voters already using eBallot for secure, transparent elections.</p>
        <div class="flex gap-3 justify-center">
            <a href="{{ route('onboarding') }}" wire:navigate class="btn bg-white text-primary rounded-full hover:bg-white/90">Register to vote</a>
            <a href="{{ route('login') }}" wire:navigate class="btn btn-outline text-white border-white rounded-full hover:bg-white/10">Sign in</a>
        </div>
    </div>
    
    {{-- Testimonials --}}
    <div class="px-8 py-20 md:px-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-semibold mb-3">What people are saying</h2>
            <p class="text-base-content/50 max-w-md mx-auto">Trusted by voters, administrators, and organizations across Nigeria.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            @foreach ([
                ['AO', 'primary', 'Adaeze Okonkwo', 'Student Union President, UniAbuja', '"eBallot made our student union election seamless. No queues, no disputes — just clean, transparent results within minutes of polls closing."'],
                ['EM', 'secondary', 'Emeka Madu', 'Electoral Officer, NLC', '"The document verification process gave us confidence that every vote counted was legitimate. The audit trail was a game changer for accountability."'],
                ['FI', 'success', 'Fatima Ibrahim', 'Verified voter, Abuja', '"I voted from my phone in under two minutes. The interface is so clean and I got instant confirmation. This is what elections should feel like."'],
            ] as [$initials, $color, $name, $role, $quote])
                <div class="bg-white shadow rounded-xl p-6 border border-base-300">
                    <div class="flex gap-1 mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-4 h-4 text-warning fill-warning" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="text-sm text-base-content/70 mb-4">{{ $quote }}</p>
                    <div class="flex items-center gap-3">
                        <div class="size-8 rounded-full bg-{{ $color }}/10 flex items-center justify-center text-xs font-semibold text-{{ $color }}">{{ $initials }}</div>
                        <div>
                            <p class="text-sm font-medium">{{ $name }}</p>
                            <p class="text-xs text-base-content/40">{{ $role }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Mobile promo --}}
    <div class="bg-white px-8 py-20 md:px-16">
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <div class="badge badge-soft badge-secondary mb-4">Mobile ready</div>
                <h2 class="text-3xl font-semibold mb-4">Vote from anywhere, on any device</h2>
                <p class="text-base-content/50 mb-6">eBallot is fully responsive and works seamlessly on your phone, tablet, or desktop. No app download required — just open your browser and vote.</p>
                <ul class="space-y-3 mb-8">
                    @foreach (['Works on all modern browsers', 'Optimized for mobile screens', 'No app download or installation needed', 'Fast load times even on slow connections'] as $item)
                        <li class="flex items-center gap-2 text-sm">
                            <svg class="w-4 h-4 text-success shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('onboarding') }}" wire:navigate class="btn btn-primary rounded-full">Get started free</a>
            </div>
            <div class="flex justify-center">
                <div class="mockup-phone border-primary">
                    <div class="camera"></div>
                    <div class="display">
                        <div class="artboard artboard-demo phone-1 bg-base-200 p-4 flex flex-col gap-3">
                            <div class="bg-base-100 rounded-xl p-3 border border-base-300">
                                <p class="text-xs font-medium mb-1">Presidential Election 2026</p>
                                <span class="badge badge-success badge-xs gap-1">
                                    <span class="size-1 rounded-full bg-current animate-pulse"></span>
                                    Live
                                </span>
                            </div>
                            <div class="space-y-2">
                                <div class="bg-base-100 rounded-lg border-2 border-primary p-3 flex items-center justify-between">
                                    <span class="text-xs font-medium">Candidate B</span>
                                    <span class="badge badge-primary badge-xs">Selected</span>
                                </div>
                                <div class="bg-base-100 rounded-lg border border-base-300 p-3">
                                    <span class="text-xs">Candidate A</span>
                                </div>
                                <div class="bg-base-100 rounded-lg border border-base-300 p-3">
                                    <span class="text-xs">Candidate C</span>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-sm rounded-full w-full">Cast my vote</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- FAQ --}}
    <div class="bg-white px-8 py-20 md:px-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-semibold mb-3">Frequently asked questions</h2>
            <p class="text-base-content/50 max-w-md mx-auto">Everything you need to know about voting on eBallot.</p>
        </div>
        <div class="max-w-2xl mx-auto space-y-2">
            @foreach ([
                ['Who can vote on eBallot?', 'Any eligible voter who has registered and had their identity document verified by an administrator. You must submit a valid NIN or voter\'s card during registration.'],
                ['How do I know my vote was counted?', 'After casting your vote you receive an on-screen confirmation. You can also view election results once polls close from your voter dashboard.'],
                ['Can I change my vote after submitting?', 'No — votes are final once submitted. This is by design to maintain election integrity and prevent vote manipulation.'],
                ['Is my vote anonymous?', 'Yes. Your identity and your ballot choice are stored separately and never linked. Not even administrators can see how you voted.'],
                ['How long does verification take?', 'Most accounts are verified within 24 hours of submitting a valid document. You\'ll be able to vote in any active elections once approved.'],
                ['What documents are accepted?', 'We currently accept National Identity Numbers (NIN) and voter\'s cards. Make sure your document image is clear and legible before uploading.'],
            ] as [$question, $answer])
                <div class="collapse collapse-arrow bg-white border border-base-300 hover:bg-primary shadow-lg">
                    <input type="radio" name="faq" />
                    <div class="collapse-title font-medium text-sm">{{ $question }}</div>
                    <div class="collapse-content text-sm text-base-content/60">
                        <p>{{ $answer }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>