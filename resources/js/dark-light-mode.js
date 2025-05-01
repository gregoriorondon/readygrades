const modoSelect = localStorage.getItem('theme');
let oscuroBtn = document.querySelector('#dark');
let claroBtn = document.querySelector('#light');
let fondoClaro = document.querySelector('.main-content');
let fondoOscuro = document.querySelector('.main-content-darkmode');
let textoTailwind = document.querySelectorAll('.text-gray-500');
let textoTailwind700 = document.querySelectorAll('.text-gray-700');

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
    claroBtn.classList.replace('hidden', 'flex');
    oscuroBtn.classList.replace('flex','hidden');
    textoTailwind.forEach(elemento => {
        elemento.classList.replace('text-gray-500', 'text-gray-300');
    });
    textoTailwind700.forEach(elemento => {
        elemento.classList.replace('text-gray-700', 'text-gray-200');
    });
    document.documentElement.style.setProperty('--fondo', '#1d232f');
    document.documentElement.style.setProperty('--texto', '#fff');
    localStorage.setItem('theme', 'dark');
});
claroBtn.addEventListener('click', ()=>{
    claroBtn.classList.replace('flex', 'hidden');
    oscuroBtn.classList.replace('hidden', 'flex');
    textoTailwind.forEach(elemento => {
        elemento.classList.replace('text-gray-300', 'text-gray-500');
    });
    textoTailwind700.forEach(elemento => {
        elemento.classList.replace('text-gray-200', 'text-gray-700');
    });
    document.documentElement.style.setProperty('--fondo', '#fff');
    document.documentElement.style.setProperty('--texto', '#000');
    localStorage.setItem('theme', 'light');
});

if (modoSelect === 'dark') {
    claroBtn.classList.replace('hidden', 'flex');
    oscuroBtn.classList.replace('flex','hidden');
    textoTailwind.forEach(elemento => {
        elemento.classList.replace('text-gray-500', 'text-gray-300');
    });
    textoTailwind700.forEach(elemento => {
        elemento.classList.replace('text-gray-700', 'text-gray-200');
    });
    document.documentElement.style.setProperty('--fondo', '#1d232f');
    document.documentElement.style.setProperty('--texto', '#fff');
} else {
    claroBtn.classList.replace('flex', 'hidden');
    oscuroBtn.classList.replace('hidden', 'flex');
    textoTailwind.forEach(elemento => {
        elemento.classList.replace('text-gray-300', 'text-gray-500');
    });
    textoTailwind700.forEach(elemento => {
        elemento.classList.replace('text-gray-200', 'text-gray-700');
    });
    document.documentElement.style.setProperty('--fondo', '#fff');
    document.documentElement.style.setProperty('--texto', '#000');
}
