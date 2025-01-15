const estadoGuardado = localStorage.getItem('estadoMenu');
let menu = document.querySelector('.menu-hiden');
let menuRound = document.querySelector('.redondeado');
let btn = document.querySelector('.menu-hiden-button');
let btnOpen = document.querySelector('.menu-button-hiden');

btn.addEventListener('click', ()=> {
    menu.classList.remove('menu-hiden', 'hidden', 'md:flex');
    menuRound.classList.remove('rounded-l-xl');
    menu.classList.add('menu-hiden-close', 'menu-open-comprobacion');
    btn.classList.add('menu-button-hiden');
    btn.classList.remove('menu-hiden-button');
    btnOpen.classList.remove('menu-button-hiden');
    btnOpen.classList.add('menu-open-button');
    localStorage.setItem('estadoMenu', 'close');
});

btnOpen.addEventListener('click', ()=> {
    menu.classList.add('menu-hiden', 'hiden', 'md:flex');
    menuRound.classList.add('rounded-l-xl');
    menu.classList.remove('menu-hiden-close', 'menu-open-comprobacion');
    btn.classList.remove('menu-button-hiden');
    btn.classList.add('menu-hiden-button');
    btnOpen.classList.add('menu-button-hiden');
    btnOpen.classList.remove('menu-open-button');
    localStorage.setItem('estadoMenu', 'open');
});
if (estadoGuardado === 'close') {
    menu.classList.remove('menu-hiden', 'hidden', 'md:flex');
    menuRound.classList.remove('rounded-l-xl');
    menu.classList.add('menu-hiden-close', 'menu-open-comprobacion');
    btn.classList.add('menu-button-hiden');
    btn.classList.remove('menu-hiden-button');
    btnOpen.classList.remove('menu-button-hiden');
    btnOpen.classList.add('menu-open-button');
} else {
    menu.classList.add('menu-hiden', 'hiden', 'md:flex');
    menuRound.classList.add('rounded-l-xl');
    menu.classList.remove('menu-hiden-close', 'menu-open-comprobacion');
    btn.classList.remove('menu-button-hiden');
    btn.classList.add('menu-hiden-button');
    btnOpen.classList.add('menu-button-hiden');
    btnOpen.classList.remove('menu-open-button');
}
