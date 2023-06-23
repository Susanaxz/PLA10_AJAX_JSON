<?php

$conexionLibreria = require_once('conexionlibreria.php');

$json = file_get_contents('php://input'); // Obtiene el JSON enviado

// convierte el JSON en un array asociativo
$datos = json_decode($json, true);

// Sanear el id con intval para convertirlo a entero y evitar inyeccion SQL
$idlibro = isset($datos['idlibros']) ? intval($datos['idlibros']) : null;



try {
    if ($idlibro === null || !is_numeric($idlibro) || $idlibro <= 0) {
        throw new Exception("Se debe seleccionar un libro", 1);
    }
    // sentencia SQL
    $sql = "DELETE FROM libros WHERE idlibros = ?";

    // preparar la consulta
    if ($conexionLibreria === false) {
        throw new Exception("Error al conectar con la bbdd" .
        mysqli_connect_error(), 1);
    }

    $consulta = $conexionLibreria->prepare($sql);

    if ($consulta === false) {
        throw new Exception("Error al preparar la consulta: " . $conexionLibreria->error, $conexionLibreria->errno);
    }

    // Sanear el id con addslashes para escapar los caracteres especiales
    $consulta->bind_param("i", $idlibro);

    if ($consulta->execute() === false) {
        throw new Exception("Error al ejecutar la consulta: " . $consulta->error, $consulta->errno);
    }

    if (mysqli_affected_rows($conexionLibreria) <= 0) {
        throw new Exception("Libro no existe", 2);
    }

    $respuesta = array(
        "codigo" => '00',
        "texto" => "Baja libro efectuada"
    );
} catch (Exception $e) {
    $respuesta = array(
        "codigo" => strval($e->getCode()),
        "error" => $e->getMessage()
    );
} finally {
    // Cierra la conexión
    mysqli_close($conexionLibreria);
}

echo json_encode($respuesta);