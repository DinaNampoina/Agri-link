<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white dark:bg-brand-900 border border-accent-300 dark:border-accent-700 rounded-md font-semibold text-xs text-accent-700 dark:text-accent-300 uppercase tracking-widest shadow-sm hover:bg-accent-50 dark:hover:bg-brand-800 focus:outline-none focus:ring-2 focus:ring-accent-400 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
