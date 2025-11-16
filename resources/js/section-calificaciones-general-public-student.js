// Boton de la barra superior
let general = document.querySelector('.overview');
let calificacion = document.querySelector('.score');
let constancia = document.querySelector('.constancia');
let horario = document.querySelector('.horario');

// Botones inferiores
let boton = document.querySelector('.calificacion-publica');
let botonDos = document.querySelector('.datos-publico');

// Secciones de la vista
let basic = document.querySelector('.data-public-student-details');
let notas = document.querySelector('.notas-students');
let constanciaVista = document.querySelector('.generar-constancia-student-details');

const switchView = (viewNane) => {
    general.classList.remove('active-button');
    calificacion.classList.remove('active-button');
    constancia.classList.remove('active-button');
    //
    basic.classList.add('hidden');
    notas.classList.add('hidden');
    constanciaVista.classList.add('hidden');
    basic.classList.remove('data-public-student-details');
    switch (viewNane) {
        case 'general':
            basic.classList.remove('hidden');
            basic.classList.add('data-public-student-details');
            general.classList.add('active-button');
            break;
        case 'calificacion':
            notas.classList.remove('hidden');
            calificacion.classList.add('active-button');
            break;
        case 'constancia':
            constanciaVista.classList.remove('hidden');
            constancia.classList.add('active-button');
            break;
        case 'horario':
            break;
        }
};

general.addEventListener('click', () => switchView('general'));
calificacion.addEventListener('click', () => switchView('calificacion'));
constancia.addEventListener('click', () => switchView('constancia'));
//
document.addEventListener('click', (e) => {
    if (e.target.matches('.calificacion-publica')) switchView('calificacion');
    if (e.target.matches('.datos-publico')) switchView('general');
});
