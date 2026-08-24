import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/admin.css', 'resources/js/admin.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    base: process.env.APP_ENV === 'production' ? 'https://mokursus.hazzi-dev.my.id/public/build/': '/',
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
