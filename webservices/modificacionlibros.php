<?php
header('Content-Type: text/html; charset=utf-8'); // Para evitar problemas de acentos

$datos = json_decode(file_get_contents('php://input'), true);

// Recuperar id, titulo, precio de la petición
$id = $datos['idlibro'];
$titulo = addslashes($datos['titulo'] ?? null); // addslashes para evitar problemas con las comillas
$precio = $datos['precio'] ?? null;

try {
    // Validar los datos
    if (!$id || !is_numeric($id) || $id <= 0) {
        throw new Exception('Se debe seleccionar un libro', 1);
    }
    if (!$titulo || !$precio || !is_numeric($precio) || $precio <= 0) {
        throw new Exception('Título y precio deben estar informados correctamente', 1);
    }

    // Incorporar el fichero de conexión a la base de datos
    require_once('conexionlibreria.php');

    // Confeccionar la sentencia SQL
    $sql = "UPDATE libros SET titulo='$titulo', precio='$precio' WHERE idlibros=$id";
    $resultado = mysqli_query($conexionLibreria, $sql);

    if (!$resultado) {
        if (mysqli_errno($conexionLibreria) == 1062) {
            throw new Exception('Ya existe un libro con el mismo título', 1062);
        } else {
            throw new Exception('Error al ejecutar la consulta: ' . mysqli_error($conexionLibreria), mysqli_errno($conexionLibreria));
        }
    }

    if (mysqli_affected_rows($conexionLibreria) === 0) {
        throw new Exception('Libro no existe o no se han modificado datos', 1);
    }
    // Confeccionar el mensaje de respuesta
    $mensaje = ['codigo' => '00', 'texto' => 'Modificación efectuada'];
} catch (Exception $e) {
    // Enviar respuesta con el error en caso de excepción
    $mensaje = ['codigo' => $e->getCode(), 'texto' => $e->getMessage()];
}

// Enviar el mensaje de respuesta en formato JSON
echo json_encode($mensaje);

// Cerrar la conexión
mysqli_close($conexionLibreria);
?>