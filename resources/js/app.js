import './bootstrap';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
import.meta.glob([
    '../images/**',
    '../fonts/**',
    './closemenuhome',
    './**', //agregar todos los archivos de JavaScript de forma automatica
]);
