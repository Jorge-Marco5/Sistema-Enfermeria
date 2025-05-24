function cambiarEstado(matricula, button, idEstadoActual) {
    const url = "../../Controllers/cambiarEstado.php"; // Cambia la URL según tu estructura de carpetas

    // Determinar el próximo estado (ciclo entre 1, 2, 3)
    const nuevoIdEstado = idEstadoActual === 1 ? 2 : idEstadoActual === 2 ? 3 : 1;

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ matricula: matricula, nuevoIdEstado: nuevoIdEstado }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Actualizar el texto y la clase del botón según el nuevo estado
            button.textContent = data.nuevoEstado;
            button.className = `estado-btn ${data.nuevoEstado.toLowerCase()}`;
            button.setAttribute("onclick", `cambiarEstado('${matricula}', this, ${nuevoIdEstado})`);
        } else {
            alert("Error al cambiar el estado: " + data.message);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Ocurrió un error al cambiar el estado.");
    });
}