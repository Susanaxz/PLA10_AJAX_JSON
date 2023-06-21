<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conexionLibreria = require_once('conexionlibreria.php');

// 
try {
    // creacion sentencia SQL
    $sql = "SELECT * FROM libros";

    // Realizar la consulta
    $consulta = $conexionLibreria->query($sql);

    if ($conexionLibreria === false) {
        throw new Exception("Error al conectar con la bbdd" .
        mysqli_connect_error(), 1);
    }

    if ($consulta === false) {
        throw new Exception("Error al realizar la consulta: " . $conexionLibreria->error, $conexionLibreria->errno);
    }

    // comprobar si hay resultados
    if ($consulta->num_rows === 0) {
        throw new Exception("No hay libros en la base de datos", 1);
    }

    // extraer el array asociativo
    $libros = $consulta->fetch_all(MYSQLI_ASSOC);  

    $respuesta = array(
        "codigo" => '00',
        "libros" => $libros
    );


} catch (Exception $e) {
    $respuesta = array(
        "codigo" => strval($e->getCode()),
        "error" => $e->getMessage()
    );
}

// var_dump($respuesta);
// devolver el array asociativo en formato JSON
echo json_encode($respuesta);

?>