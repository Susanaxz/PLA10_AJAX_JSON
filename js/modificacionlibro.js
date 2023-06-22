function modificacionLibro() {
  // Recogemos los datos del formulario
  let id = document.querySelector("#id").value;
  let titulo = document.querySelector("#titulo").value;
  let precio = document.querySelector("#precio").value;

  // Validamos los datos
  if (!id || isNaN(id) || id <= 0) {
    window.alert("Se debe seleccionar un libro");
    return;
  }
  if (!titulo || !precio) {
    window.alert("Todos los datos son obligatorios");
    return;
  }

  // crear el objeto con los datos del libro
  let libro = {
    idlibro: id,
    titulo: titulo,
    precio: precio,
  };

  // Realizar la petición AJAX al servidor para MODIFICAR el libro
  fetch("webservices/modificacionlibros.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(libro),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("HTTP error " + response.status);
      }
      return response.json();
    })
    .then((mensaje) => {
      if (mensaje.codigo === "00") {
        // Mostrar el mensaje de respuesta
        document.querySelector("#mensajes").innerText = mensaje.texto;
        // Volver a ejecutar la función de consulta de libros
        consultarLibros();
      } else {
        throw mensaje.error;
      }
    })
    .catch((error) => {
      window.alert("Error al realizar la modificación: " + error);
    });
}