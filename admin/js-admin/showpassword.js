const ch = document.getElementById('checkbox');
const cont = document.getElementById('pass');

//formulario de resgistro
const ch1 = document.getElementById('checkbox1');
const cont1 = document.getElementById('pass1');
const cont2 = document.getElementById('pass1c');

ch.addEventListener("click", mostrar);
ch1.addEventListener("click", mostrarf);

function mostrar() {
    if (ch.checked === true){
        cont.type = "text";
    } 
    else if (ch.checked === false) {
        cont.type = "password"
    }   
};

function mostrarf() {
    if (ch1.checked === true){
        cont1.type = "text";
        cont2.type = "text";
    } 
    else if (ch1.checked === false) {
        cont1.type = "password";
        cont2.type = "password";
    }   
}
