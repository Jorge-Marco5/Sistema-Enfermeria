
function filtrarTabla() {
    const input = document.getElementById("busqueda");
    const filtro = input.value.toLowerCase();
    const tabla = document.querySelector(".user-table tbody");
    const filas = tabla.getElementsByTagName("tr");

    for (let i = 0; i < filas.length; i++) {
        const celda = filas[i].getElementsByTagName("td")[0]; // Columna de matrícula
        if (celda) {
            const texto = celda.textContent || celda.innerText;
            if (texto.toLowerCase().indexOf(filtro) > -1) {
                filas[i].style.display = "";
            } else {
                filas[i].style.display = "none";
            }
        }
    }
}
