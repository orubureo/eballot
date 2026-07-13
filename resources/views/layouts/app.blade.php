<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body>

    @livewire('navbar')
    <main class="bg-[#f4f7fa] flex flex-col min-h-screen space-y-4 mt-10 @auth lg:mt-0 lg:pl-64 @endauth">

        <div>
            {{ $slot }}
        </div>

    </main>
    @if (request()->routeIs('home', 'login', 'onboarding'))
        @livewire('footer')
    @endif

    @livewireScripts
</body>

</html>