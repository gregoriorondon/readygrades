const btn1 = document.querySelector('.m-student');
const btn2 = document.querySelector('.m-teacher');

btn1.addEventListener('click', redireccion1);
btn2.addEventListener('click', redireccion2);

function redireccion1(){
    window.location.assign('./estudiantes.php');
}

function redireccion2(){
    window.location.assign('./login.php');
}
