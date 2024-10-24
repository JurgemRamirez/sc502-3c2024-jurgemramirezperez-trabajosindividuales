
var estudiantes = [
    {nombre: "Rocio", apellido: "Romero", nota: 78},
    {nombre: "David", apellido: "Avila", nota: 100},
    {nombre: "Juliana", apellido: "Zimmer", nota: 84},
    {nombre: "Julio", apellido: "Mora", nota: 100},
    {nombre: "Roberto", apellido: "Leon", nota: 194}
];

function mostrarEstudiantes() {
    var lista = document.getElementById("listaEstudiantes");
    var sumaNotas = 0;
    
  
    estudiantes.forEach(function(estudiante) {
        lista.innerHTML += `<p>${estudiante.nombre} ${estudiante.apellido}</p>`;
        sumaNotas += estudiante.nota;
    });

    var promedio = sumaNotas / estudiantes.length;

    var promedioElemento = document.getElementById("promedio");
    promedioElemento.innerHTML = `El promedio: ${promedio.toFixed(2)}`;
}


window.onload = mostrarEstudiantes;
