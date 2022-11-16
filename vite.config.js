import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/sass/dashboard/app.scss',
                'resources/js/dashboard.js',
                'resources/sass/front/app.scss',
                'resources/js/front.js',
            ],
            refresh: true,
        }),
    ],
});
