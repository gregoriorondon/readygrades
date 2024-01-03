const ch = document.getElementById('checkbox');
const cont = document.getElementById('pass');
function mostrar(item) {
    if (ch.checked === true){
        cont.type = "text";
    } 
    else if (ch.checked === false) {
        cont.type = "password"
    }   
}

