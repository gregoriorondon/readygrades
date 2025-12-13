function regresar() {
    history.back();
}
document.addEventListener('DOMContentLoaded', function() {
    let salir = document.querySelectorAll('.exit');
    salir.forEach(function (boton) {
        boton.addEventListener('click', regresar);
    });
});
