function altaLibro() {
    // recuperar todos los datos del formulario
    let titulo = document.querySelector('#titulo').value;
    let precio = document.querySelector('#precio').value;

    // validar los datos
    if (titulo.trim() === '' || precio.trim() === '') {
        window.alert('Todos los datos son obligatorios');
        return;
    }


    // Realizar la petición AJAX al servidor para dar de alta el libro

    fetch('webservices/altalibros.php', {
        method: 'POST',
        body: JSON.stringify({
            titulo: titulo,
            precio: precio

        }), headers: {
            'Content-Type': 'application/json'
        }
    }).then(response => response.json())
        .then(mensaje => {
            // el atributo código será 00 si todo ha ido bien
            if (mensaje.codigo === '00') {
                document.querySelector('#mensajes').innerText = mensaje.texto;
            
                // limpiar el formulario
                document.querySelector('#formulario').reset();
            } else {
                throw (mensaje.error);
            }
        }).catch(error => {
            window.alert('Error al realizar el alta: ' + error);
        });
}