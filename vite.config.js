import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
           nput: ['resources/js/app.js'],   // ← JS seulement, le CSS est importé dans app.js
            refresh: true,
        }),
        tailwindcss(),
    ],
});
