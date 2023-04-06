import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/app.css',
                'public/js/admin.js',
                'public/css/app.css',
                'public/css/admin.css',
            ],
            refresh: true,
        }),
    ],
});
