import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
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
            ],
            refresh: true,
        }),
    ],
});
