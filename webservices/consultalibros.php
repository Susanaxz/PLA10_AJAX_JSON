<?php
// Permite mostrar los errores en el servidor
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conexionLibreria = require_once('conexionlibreria.php');

// Obtiene el JSON enviado
$json = file_get_contents('php://input');

// Convierte el JSON en un array asociativo
$datos = json_decode($json, true);

// Recuperar la cadena de búsqueda o asignar un valor predeterminado
$buscar = $datos['buscar'] ?? '';

try {
    //Recuperar el valor de la búsqueda y la cantidad de libros a mostrar
    $buscar = $datos['buscar'] ?? '';
    $mostrar = isset($datos['mostrar']) ? intval($datos['mostrar']) : 10; // valor predeterminado de 10 si no se especifica

    //Preparar la consulta SQL
    $sql = "SELECT * FROM libros WHERE titulo LIKE ? ORDER BY titulo LIMIT ?";
    $consulta = $conexionLibreria->prepare($sql);
    $busqueda = "%$buscar%";
    $consulta->bind_param("si", $busqueda, $mostrar);

    if ($consulta->execute() === false) {
        throw new Exception("Error al ejecutar la consulta: " . $consulta->error, $consulta->errno);
    }

    $resultado = $consulta->get_result();
    $libros = $resultado->fetch_all(MYSQLI_ASSOC);

    $response = array(
        "codigo" => "00",
        "libros" => $libros
    );

    echo json_encode($response);

} catch (Exception $e) {
    $error = array(
        "codigo" => strval($e->getCode()),
        "mensaje" => $e->getMessage()
    );

    echo json_encode($error);
}

?>