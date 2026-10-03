<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AgriLink') }}</title>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 dark:text-gray-100 antialiased">
    <div class="min-h-screen bg-brand-50 dark:bg-brand-950">
        <nav
            class="bg-white dark:bg-brand-900 border-b border-brand-200 dark:border-brand-800 px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold text-brand-700 dark:text-brand-400">🌿 AgriLink</a>
            <div class="flex items-center gap-4">
                <button id="theme-toggle" type="button"
                    class="p-2 rounded-md text-accent-600 dark:text-accent-300 hover:bg-brand-50 dark:hover:bg-brand-800">
                    <svg id="theme-icon-dark" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg id="theme-icon-light" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm text-accent-600 dark:text-accent-400">Mon espace</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-accent-600 dark:text-accent-400">Connexion</a>
                    <a href="{{ route('register') }}"
                        class="text-sm bg-brand-600 hover:bg-brand-700 text-white px-3 py-1.5 rounded-md">Devenir
                        vendeur</a>
                @endauth
            </div>
        </nav>

        <script>
            const html = document.documentElement;
            const iconDark = document.getElementById('theme-icon-dark');
            const iconLight = document.getElementById('theme-icon-light');

            function applyTheme(isDark) {
                html.classList.toggle('dark', isDark);
                iconDark.classList.toggle('hidden', !isDark);
                iconLight.classList.toggle('hidden', isDark);
            }

            applyTheme(html.classList.contains('dark'));

            document.getElementById('theme-toggle').addEventListener('click', () => {
                const isDark = !html.classList.contains('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
                applyTheme(isDark);
            });
        </script>
        <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
