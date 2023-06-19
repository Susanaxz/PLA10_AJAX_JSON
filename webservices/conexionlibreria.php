<?php


// Conectando, seleccionando la base de datos

$conexionLibreria = mysqli_connect('localhost', 'root', '', 'libreria');

// Verificar la conexion 
if (mysqli_connect_errno()) {
    echo "Error al conectar a la base de datos: " . mysqli_connect_error();
    exit();

}

?>