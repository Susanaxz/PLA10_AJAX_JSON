

<?php
$host = 'localhost';
$db   = 'libreria';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$conexionLibreria = new mysqli($host, $user, $pass, $db);

if ($conexionLibreria->connect_error) {
   die("Connection failed: " . $conexionLibreria->connect_error);
}

return new mysqli($host, $user, $pass, $db);

?>
