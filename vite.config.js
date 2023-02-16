import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
        chunkSizeWarningLimit: 2600
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/product.js',
                'resources/js/auction.js',
                'resources/js/artwork.js',
                'resources/js/notification.js',
            ],
            refresh: true,
            valetTls: true,
        }),
    ],
});
