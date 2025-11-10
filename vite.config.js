import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "public/css/style.css",
                "resources/css/app.css",
                "resources/css/app.scss",
                "resources/css/estilos.css",
                "resources/css/fonts.css",
                "resources/js/app.js",
                "resources/js/closemenuhome",
                "resources/js/dark-light-mode",
                "resources/js/menu-admin-hide",
                "resources/js/password-show-hide",
                "resources/js/section-calificaciones-general-public-student",
                "resources/js/back-cedula-public-studens",
                "resources/js/modales",
                "resources/js/autocompletado-carrera",
                "resources/js/autocompletado-nucleos",
                "resources/js/app.jsx",
                "resources/js/chart.js",
            ],
            refresh: true,
        }),
    ],
    assetsInclude: ['**/*.ufm'],
});
