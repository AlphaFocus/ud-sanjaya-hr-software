<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>UD. Sanjaya</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.css') }}">

    <link rel="icon" href="{{ asset('img/logo.svg') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <script src="https://kit.fontawesome.com/c21a2021f6.js" crossorigin="anonymous"></script>
</head>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="xl:h-screen flex flex-col bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="p-2 flex h-full">
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
    @livewire('livewire-ui-modal')
</body>

</html>
