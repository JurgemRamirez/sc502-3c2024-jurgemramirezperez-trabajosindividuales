function calcularDeduccion() {
    var salarioBruto = parseFloat(document.getElementById("salarioBruto").value);
    
    if (isNaN(salarioBruto) || salarioBruto <= 0) {
        alert("Por favor haga el ingreso de un salario bruto válido");
        return;
    }

    
    var cargasSociales = salarioBruto * 0.0934;


    var impuestoRenta = 0;

    if (salarioBruto > 4199000) {
        impuestoRenta += (salarioBruto - 4199000) * 0.25;
        salarioBruto = 4199000;
    }
    if (salarioBruto > 2519000) {
        impuestoRenta += (salarioBruto - 2519000) * 0.20;
        salarioBruto = 2519000;
    }
    if (salarioBruto > 1379000) {
        impuestoRenta += (salarioBruto - 1379000) * 0.15;
        salarioBruto = 1379000;
    }
    if (salarioBruto > 941000) {
        impuestoRenta += (salarioBruto - 941000) * 0.10;
    }

    var salarioNeto = parseFloat(document.getElementById("salarioBruto").value) - cargasSociales - impuestoRenta;

    document.getElementById("cargasSociales").innerHTML = `Cargas Sociales: ₡${cargasSociales.toFixed(2)}`;
    document.getElementById("impuestoRenta").innerHTML = `Impuesto sobre la Renta: ₡${impuestoRenta.toFixed(2)}`;
    document.getElementById("salarioNeto").innerHTML = `Salario Neto: ₡${salarioNeto.toFixed(2)}`;
}
