// hacer la consulta de libros con una petición AJAX
function consultarLibros() {
    //Recoger los datos de la búsqueda
    let buscar = document.querySelector("#buscar").value;
    let mostrar = parseInt(document.querySelector("#mostrar").value);

    let busqueda = {
        buscar: buscar, 
        mostrar: mostrar
    };

    //Realizar la petición AJAX al servidor para BUSCAR los libros
    fetch("webservices/consultalibros.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(busqueda),
    })
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
                <tr onclick='trasladarDatos(this)'>
                        <td class='idlibro'>${libro.idlibros}</td>
                        <td class='titulo'>${libro.titulo}</td>
                        <td class='precio'>${libro.precio}</td>
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

// función para trasladar los datos al formulario
function trasladarDatos(tr) {
    document.querySelector('#id').value = tr.querySelector('.idlibro').innerText;
    document.querySelector('#titulo').value = tr.querySelector('.titulo').innerText;
    document.querySelector('#precio').value = tr.querySelector('.precio').innerText;
}