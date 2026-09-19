<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'AgriLink') }}</title>
        <script>
            if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        </script>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 dark:text-gray-100 antialiased">
        <div class="min-h-screen bg-brand-50 dark:bg-brand-950">
            <nav class="bg-white dark:bg-brand-900 border-b border-brand-200 dark:border-brand-800 px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold text-brand-700 dark:text-brand-400">🌿 AgriLink</a>
                <div>
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm text-accent-600 dark:text-accent-400">Mon espace</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-accent-600 dark:text-accent-400 mr-4">Connexion</a>
                        <a href="{{ route('register') }}" class="text-sm bg-brand-600 hover:bg-brand-700 text-white px-3 py-1.5 rounded-md">Devenir vendeur</a>
                    @endauth
                </div>
            </nav>
            <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
