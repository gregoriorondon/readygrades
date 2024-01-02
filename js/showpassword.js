// function mostrar(item) {
//     if (document.getElementById('pass').type == "password") {
//         document.getElementById('pass').type = "text";
//     } else {
//         document.getElementById('pass').type = "password";
//     }
// }

// const ch = document.querySelector('#checkbox');
function mostrar(item) {
    if (document.getElementById('checkbox').checked === true){
        document.getElementById('pass').type = "text";
    } 
    else if (document.getElementById('checkbox').checked === false) {
        document.getElementById('pass').type = "password"
    }   
}

