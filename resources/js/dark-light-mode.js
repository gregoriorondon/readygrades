const modoSelect = localStorage.getItem('theme');
let oscuroBtn = document.querySelector('#dark');
let claroBtn = document.querySelector('#light');
let fondoClaro = document.querySelector('.main-content');
let fondoOscuro = document.querySelector('.main-content-darkmode');

// oscuroBtn.addEventListener('click', ()=>{
//     oscuroBtn.classList.remove('flex');
//     oscuroBtn.classList.add('hidden');
//     claroBtn.classList.remove('hidden');
//     claroBtn.classList.add('flex');
//     fondoClaro.classList.remove('main-content');
//     fondoClaro.classList.add('main-content-darkmode');
//     localStorage.setItem('theme', 'dark');
// });
oscuroBtn.addEventListener('click', ()=>{
    oscuroBtn.classList.remove('flex');
    oscuroBtn.classList.add('hidden');
    claroBtn.classList.remove('hidden');
    claroBtn.classList.add('flex');
    document.documentElement.style.setProperty('--fondo', '#1d232f');
    document.documentElement.style.setProperty('--texto', '#fff');
    localStorage.setItem('theme', 'dark');
});
claroBtn.addEventListener('click', ()=>{
    claroBtn.classList.remove('flex');
    claroBtn.classList.add('hidden');
    oscuroBtn.classList.remove('hidden');
    oscuroBtn.classList.add('flex');
    document.documentElement.style.setProperty('--fondo', '#fff');
    document.documentElement.style.setProperty('--texto', '#000');
    localStorage.setItem('theme', 'light');
});

if (modoSelect === 'dark') {
    oscuroBtn.classList.remove('flex');
    oscuroBtn.classList.add('hidden');
    claroBtn.classList.remove('hidden');
    claroBtn.classList.add('flex');
    document.documentElement.style.setProperty('--fondo', '#1d232f');
    document.documentElement.style.setProperty('--texto', '#fff');
} else {
    claroBtn.classList.remove('flex');
    claroBtn.classList.add('hidden');
    oscuroBtn.classList.remove('hidden');
    oscuroBtn.classList.add('flex');
    document.documentElement.style.setProperty('--fondo', '#fff');
    document.documentElement.style.setProperty('--texto', '#000');
}
