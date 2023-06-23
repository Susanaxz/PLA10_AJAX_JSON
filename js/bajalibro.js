function bajaLibro(){
    //Recoger los datos del formulario
    let id = document.querySelector("#id").value;

    //Validar los datos
    if (!id || isNaN(id) || id <= 0) {
        window.alert("Se debe seleccionar un libro");
        return;
    }

    //Crear el objeto con los datos del libro
    let libro = {
        idlibros: id
    };

    //Realizar la petición AJAX al servidor para BORRAR el libro
    fetch("webservices/bajalibros.php", {
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
        return response.json(); // Añade esta línea
      })
      .then((mensaje) => {
        if (mensaje.codigo === "00") {
          //Mostrar el mensaje de respuesta
          document.querySelector("#mensajes").innerText = mensaje.texto;
          //Volver a ejecutar la función de consulta de libros
          consultarLibros();
        } else {
          throw mensaje.error;
        }
      })
      .catch((error) => {
        window.alert("Error al realizar la baja: " + error);
      });

}