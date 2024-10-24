function verificarEdad() {
    var edad = document.getElementById("edad").value;
    var mensaje = document.getElementById("mensaje");

    if (edad >= 18) {
        mensaje.innerHTML = "Eres mayor de edad.";
    } else {
        mensaje.innerHTML = "Eres menor de edad.";
    }
}
