<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
        @livewireStyles
    </head>
    <body class="bg-background antialiased max-w-7xl mx-auto p-6">
        {{ $slot }}

        <x-toast />
        @livewireScripts
    </body>
</html>
