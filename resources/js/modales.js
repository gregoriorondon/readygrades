let dialogo = document.querySelector('#modal');
let botonAbrir = document.querySelector('#abrirmodal');
let botonCerrar = document.querySelectorAll('#cerrarmodal');

botonAbrir.addEventListener('click', ()=>{
    dialogo.showModal();
});
botonCerrar.forEach(element => {
    element.addEventListener('click', ()=>{
        dialogo.close();
    })
});
