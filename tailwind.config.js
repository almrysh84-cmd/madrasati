/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './app/Http/Livewire/**/*.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                'cairo': ['Cairo', 'sans-serif'],
            },
            colors: {
                'madrasati': {
                    '50':  '#eff6ff',
                    '100': '#dbeafe',
                    '500': '#3b82f6',
                    '600': '#2563eb',
                    '700': '#1d4ed8',
                    '900': '#1e3a8a',
                },
            },
        },
    },
    plugins: [],
}
