let boton = document.querySelector('.closebtn');
let menuMovile = document.querySelector('.movile-menu-open-open');
let menuHambur = document.querySelector('.openmenu');
let menu = document.querySelector('.menu-float-movile');

boton.addEventListener('click', ()=> {
    // alert('Hola');
    menuMovile.classList.remove('movile-menu-open');
    menuMovile.classList.add('movile-menu-close');
});
menuHambur.addEventListener('click', ()=> {
    // alert('Hola');
    menuMovile.classList.add('movile-menu-open');
    menuMovile.classList.remove('movile-menu-open-open');
    menuMovile.classList.remove('movile-menu-close');
});
