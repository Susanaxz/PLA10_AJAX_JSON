<?php

// permite mostrar los errores en el servidor web por pantalla (para depurar)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conexionLibreria = require_once('conexionlibreria.php');


$json = file_get_contents('php://input'); // Obtiene el JSON enviado

// convierte el JSON en un array asociativo
$datos = json_decode($json, true);

try {
    // Sanear el título con addslashes para escapar los caracteres especiales
    $titulo = isset($datos['titulo']) ? addslashes($datos['titulo']) : null;
    $precio = isset($datos['precio']) ? $datos['precio'] : null;

    // Validar título informado y precio informado, numérico y mayor que 0
    if ($titulo !== null && $precio !== null && is_numeric($precio) && $precio > 0) {
        // insertar el libro en la base de datos con seguridad para evitar inyeccion SQL
        $conexionLibreria->query("SET NAMES 'utf8'");

        if ($conexionLibreria === false) {
            throw new Exception("Error al conectar con la base de datos: " . mysqli_connect_error(), 1);
        }
        $stmt = $conexionLibreria->prepare("INSERT INTO libros (titulo, precio) VALUES (?, ?)");
        if ($stmt === false) {
            throw new Exception("Error al preparar la consulta: " . $conexionLibreria->error, $conexionLibreria->errno);
        }

        $stmt->bind_param("sd", $titulo, $precio);

        if ($stmt->execute() === TRUE) {
            $respuesta = array(
                    "codigo" => '00',
                    "texto" => "Alta libro efectuada"
                );
        } else {
            // Detectar título duplicado (que es clave única) preguntando por el código 1062
            if ($stmt->errno == 1062) {
                throw new Exception("El título ya está en uso", $stmt->errno);
            } else {
                throw new Exception("Error al insertar el libro: " . $stmt->error, $stmt->errno);
            }
        }
    } else {
        throw new Exception("Error: los datos del libro son inválidos o incompletos", 1);
    }
} catch (Exception $e) {
    $respuesta = array(
        "codigo" => strval($e->getCode()),
        "error" => $e->getMessage()
    );
}

// devolver el array asociativo en formato JSON
echo json_encode($respuesta);

?>