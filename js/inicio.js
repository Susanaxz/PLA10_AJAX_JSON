document.querySelector('#alta').onclick = function () { altaLibro() };

document.querySelector('#baja').onclick = function () { bajaLibro() };

document.querySelector('#modificacion').onclick = function () { modificacionLibro() };

// cargar todos los libros con la función consultarLibros()

consultarLibros();

// añadir el evento change al campo de libros a mostrar
document.querySelector("#mostrar").addEventListener("change", consultarLibros);

