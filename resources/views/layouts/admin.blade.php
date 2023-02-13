<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel='icon' href='{{Vite::asset('resources/image/favicon.ico')}}' type='image/x-icon'>
        <link rel='shortcut icon' href='{{Vite::asset('resources/image/favicon.ico')}}' type='image/x-icon'>
        <meta name="robots" content="noindex, follow" />
        <meta name="robots" content="none" />
        <meta name="googlebot" content="noindex">
        <meta name="googlebot-news" content="nosnippet">

        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        @vite(['resources/js/app.js', 'resources/css/app.css', 'resources/js/auction.js', 'resources/js/artwork.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.admin-navigation')
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="flex flex-row">
                            @if($header->attributes->has('url'))
                                <a href="{{$header->attributes->get('url')}}" class="text-gray-400 font-bold items-center flex pr-2">
                                    <i class="fa fa-arrow-circle-left fa-lg pr-2"></i>
                                </a>
                            @endif
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endif
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
@yield('js')
</html>
