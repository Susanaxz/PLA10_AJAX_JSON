<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$json = file_get_contents('php://input'); // Obtiene el JSON enviado

// convierte el JSON en un array asociativo
$datos = json_decode($json, true);

require_once('conexionlibreria.php');

$titulo = isset($datos['titulo']) ? $datos['titulo'] : null;
$precio = isset($datos['precio']) ? $datos['precio'] : null;

if ($titulo !== null && $precio !== null) {
    // realizar la logica de la insercion del libro en la base de datos
    // y devolver el resultado de la operacion en un array asociativo

    // insertar el libro en la base de datos con seguridad para evitar inyeccion SQL
    $conexionLibreria->query("SET NAMES 'utf8'");
    $stmt = $conexionLibreria->prepare("INSERT INTO libros (titulo, precio) VALUES (?, ?)");
    $stmt->bind_param("sd", $titulo, $precio);

    if ($stmt->execute() === TRUE) {
        $respuesta = array(
            "codigo" => '00',
            "texto" => "Libro insertado correctamente"
        );
    } else {
        $respuesta = array(
            "codigo" => '01',
            "texto" => "Error al insertar el libro: " . $conexionLibreria->error
        );
    }
} else {
    $respuesta = array(
        "codigo" => '01',
        "texto" => "Error: faltan datos del libro"
    );
}

// devolver el array asociativo en formato JSON
echo json_encode($respuesta);
