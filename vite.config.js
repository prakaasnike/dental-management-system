import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        // By default, Vite only listens on localhost (127.0.0.1).
        // To expose the server to other devices, set the host option to '0.0.0.0'.
        host: '0.0.0.0', // Listen on all network interfaces
        port: 5173, // Use the same port as Laragon's auto host
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: [
                ... refreshPaths,
                'app/Livewire/**',
                'app/Filament/**',
            ],
        }),
    ],
});