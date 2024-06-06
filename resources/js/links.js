const btn1 = document.querySelector('.m-student');
const btn2 = document.querySelector('.m-teacher');
const btn3 = document.querySelector('.home');

btn1.addEventListener('click', redireccion1);
btn2.addEventListener('click', redireccion2);
btn3.addEventListener('click', redireccion3);

function redireccion1(){
    window.location.assign('./estudiantes.php');
}

function redireccion2(){
    window.location.assign('./login.php');
}

function redireccion3() {
    window.location.assign('./')
}
