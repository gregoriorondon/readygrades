import './bootstrap';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
import.meta.glob([
    '../images/**',
    '../fonts/**',
    './closemenuhome',
    './**', //agregar todos los archivos de JavaScript de forma automatica
]);
import NProgress from 'nprogress'
import 'nprogress/nprogress.css'


NProgress.configure({
    showSpinner: false, // quita el spinner
    speed: 500, trickleSpeed: 200,
});

window.addEventListener('beforeunload', () => {
    NProgress.start();
});

window.addEventListener('load', () => {
    NProgress.done();
});

// Seccion para ponerlo en la parte inferior del menu
const nav = document.querySelector('nav.navbar');
if (nav) {
    const navHeight = nav.offsetHeight;
    const style = document.createElement('style');
    style.innerHTML = `
        #nprogress .bar {
            top: ${navHeight}px !important;
            z-index: 1;
        }
    `;
    document.head.appendChild(style);
}

NProgress.start();
fetch('/127.0.0.1:8000/')
    .then(r => r.json())
    .finally(() => NProgress.done());

