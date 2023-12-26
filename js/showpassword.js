function mostrar(item) {
    if (document.getElementById('pass').type == "password") {
        document.getElementById('pass').type = "text";
    } else {
        document.getElementById('pass').type = "password";
    }
}
