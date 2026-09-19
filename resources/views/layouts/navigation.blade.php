<nav x-data="{ open: false }" class="bg-white dark:bg-brand-900 border-b border-brand-200 dark:border-brand-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-xl font-bold text-brand-700 dark:text-brand-400">
                        🌿 AgriLink
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dashboard') ? 'border-brand-500 text-gray-900 dark:text-white' : 'border-transparent text-gray-500 dark:text-gray-400' }} text-sm font-medium">
                        Dashboard
                    </a>
                    <a href="{{ route('annonces.index') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('annonces.*') ? 'border-brand-500 text-gray-900 dark:text-white' : 'border-transparent text-gray-500 dark:text-gray-400' }} text-sm font-medium">
                        Mes annonces
                    </a>
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.produits.index') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.produits.*') ? 'border-brand-500 text-gray-900 dark:text-white' : 'border-transparent text-gray-500 dark:text-gray-400' }} text-sm font-medium">
                            Produits
                        </a>
                        <a href="{{ route('admin.annonces.index') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.annonces.*') ? 'border-brand-500 text-gray-900 dark:text-white' : 'border-transparent text-gray-500 dark:text-gray-400' }} text-sm font-medium">
                            Toutes annonces
                        </a>
                        <a href="{{ route('admin.users.index') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.users.*') ? 'border-brand-500 text-gray-900 dark:text-white' : 'border-transparent text-gray-500 dark:text-gray-400' }} text-sm font-medium">
                            Vendeurs
                        </a>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">
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

                <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                    <button @click="open = ! open"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 dark:text-gray-300 bg-white dark:bg-brand-900 hover:text-brand-700">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="ms-1 fill-current h-4 w-4" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" style="display: none;"
                        class="absolute z-50 mt-2 w-48 rounded-md shadow-lg end-0">
                        <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white dark:bg-brand-800">
                            <a href="{{ route('profile.edit') }}"
                                class="block w-full px-4 py-2 text-start text-sm text-gray-700 dark:text-gray-300 hover:bg-brand-50 dark:hover:bg-brand-700">Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="block w-full px-4 py-2 text-start text-sm text-gray-700 dark:text-gray-300 hover:bg-brand-50 dark:hover:bg-brand-700">Déconnexion</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:bg-brand-50">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}"
                class="block ps-3 pe-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 dark:text-gray-400">Tableau de bord</a>
            <a href="{{ route('annonces.index') }}"
                class="block ps-3 pe-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 dark:text-gray-400">Mes
                annonces</a>
        </div>
        <div class="pt-4 pb-1 border-t border-brand-200 dark:border-brand-800">
            <div class="px-4 font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}"
                    class="block ps-3 pe-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 dark:text-gray-400">Profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                        class="block ps-3 pe-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 dark:text-gray-400">Déconnexion</a>
                </form>
            </div>
        </div>
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
