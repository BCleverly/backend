@props([
    'fullWidth' => false,
    'header',
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <x:backend::layouts.navigation/>

            <!-- Page Heading -->
            <header class="max-w-7xl mx-auto pt-6 px-4 sm:px-6 lg:px-8 sm:flex sm:items-center sm:justify-between mb-4">
                <h2 class="text-xl leading-6 font-semibold text-gray-900">
                    {{ $header }}
                </h2>
                <div class="mt-3 flex sm:mt-0 sm:ml-4">
                    @isset($headerButtons)
                        {{ $headerButtons }}
                    @endisset
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div class="{{ $fullWidth === false ? 'max-w-7xl' : '' }} mx-auto sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
