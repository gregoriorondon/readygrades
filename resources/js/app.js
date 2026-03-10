import './bootstrap';
import './chart.js';
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

let parentMenu = 'body';

const menu = document.querySelector('.movilmenu');

if (document.querySelector('#dash')) {
    parentMenu = '#dash';
} else if (menu) {
    const estilo = window.getComputedStyle(menu);
    if  (estilo.display === 'none') {
        parentMenu = '.menu';
    } else if (estilo.display === 'block') {
        parentMenu = '.movileMenu';
    }
}
NProgress.configure({
    showSpinner: false,
    speed: 500, trickleSpeed: 200,
    parent: parentMenu,
});

window.addEventListener('beforeunload', () => {
    NProgress.start();
});

window.addEventListener('load', () => {
    NProgress.done();
});

NProgress.start();
fetch('/')
    .then(r => r.json())
    .finally(() => NProgress.done());

