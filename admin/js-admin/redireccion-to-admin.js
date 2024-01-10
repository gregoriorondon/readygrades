const boton = document.querySelector('.sub');

boton.addEventListener('click', redireccion);

function redireccion() {
    window.location.assign('login-admin.php');
}
