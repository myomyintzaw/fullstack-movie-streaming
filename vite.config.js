


import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel([
        'resources/js/Test.jsx',
        'resources/js/Movie/CreateMovie.jsx',
        'resources/js/Movie/EditMovie.jsx',
        'resources/js/Serie/EditSerie.jsx',
        'resources/js/Serie/CreateSerie.jsx',
        // for website component
        'resources/js/Web/Movie.jsx',
        'resources/js/Web/Serie.jsx',
        //dashboard
        'resources/js/Web/Dashboard.jsx',



    ]),
        react(),
    ],
});
