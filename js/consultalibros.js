// hacer la consulta de libros con una petición AJAX
function consultarLibros() {
    fetch("webservices/consultalibros.php")
        .then((response) => {
        if (!response.ok) {
            throw new Error("HTTP error " + response.status);
        }
        console.log(response.headers.get("content-type")); // para verificar el tipo de contenido
            return response.json();
            
        })
        
        .then((libros) => {
    // el atributo código será 00 si todo ha ido bien
    if (libros.codigo === "00") {
        // limpiar la tabla
        let tabla = document.querySelector("#listalibros");
        tabla.innerHTML = "";

        // recorrer todos los libros y añadirlos a la tabla
        let rows = "";
        for (let libro of libros.libros) {
            rows += `
                <tr>
                <td>${libro.idlibros}</td>
                <td>${libro.titulo}</td>
                <td>${libro.precio}</td>
                <td><button onclick="bajaLibro(${libro.id})">Baja</button></td>
                <td><button onclick="modificacionLibro(${libro.id})">Modificación</button></td>
                </tr>
            `;
        }
        tabla.innerHTML = rows;
    } else {
        throw libros.texto; // lanzar una excepción para que se ejecute el catch
    }
})
.catch((error) => {
    window.alert("Error al realizar la consulta: " + error);
});
}