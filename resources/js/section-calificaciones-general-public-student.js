let general = document.querySelector('.overview');
let calificacion = document.querySelector('.score');
let boton = document.querySelector('.calificacion-publica');
let basic = document.querySelector('.data-public-student-details');

calificacion.addEventListener('click', ()=>{
    basic.classList.remove('data-public-student-details');
    general.classList.remove('active-button');
    basic.classList.add('hidden');
    calificacion.classList.add('active-button');
});

general.addEventListener('click', ()=>{
    basic.classList.remove('hidden');
    calificacion.classList.remove('active-button');
    basic.classList.add('data-public-student-details');
    general.classList.add('active-button');
});

boton.addEventListener('click', ()=>{
    basic.classList.remove('data-public-student-details');
    general.classList.remove('active-button');
    basic.classList.add('hidden');
    calificacion.classList.add('active-button');
});
