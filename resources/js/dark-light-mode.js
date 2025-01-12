const modoSelect = localStorage.getItem('theme');
let oscuroBtn = document.querySelector('#dark');
let claroBtn = document.querySelector('#light');
let fondoClaro = document.querySelector('.main-content');
let fondoOscuro = document.querySelector('.main-content-darkmode');

oscuroBtn.addEventListener('click', ()=>{
    oscuroBtn.classList.remove('flex');
    oscuroBtn.classList.add('hidden');
    claroBtn.classList.remove('hidden');
    claroBtn.classList.add('flex');
    fondoClaro.classList.remove('main-content');
    fondoClaro.classList.add('main-content-darkmode');
    localStorage.setItem('theme', 'dark');
});
claroBtn.addEventListener('click', ()=>{
    claroBtn.classList.remove('flex');
    claroBtn.classList.add('hidden');
    oscuroBtn.classList.remove('hidden');
    oscuroBtn.classList.add('flex');
    fondoClaro.classList.remove('main-content-darkmode');
    fondoClaro.classList.add('main-content');
    localStorage.setItem('theme', 'light');
});

if (modoSelect === 'dark') {
    oscuroBtn.classList.remove('flex');
    oscuroBtn.classList.add('hidden');
    claroBtn.classList.remove('hidden');
    claroBtn.classList.add('flex');
    fondoClaro.classList.remove('main-content');
    fondoClaro.classList.add('main-content-darkmode');
} else {
    claroBtn.classList.remove('flex');
    claroBtn.classList.add('hidden');
    oscuroBtn.classList.remove('hidden');
    oscuroBtn.classList.add('flex');
    fondoClaro.classList.remove('main-content-darkmode');
    fondoClaro.classList.add('main-content');

}
