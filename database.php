<?php
$mysqli = new mysqli('localhost', 'root', 'pass', 'yucaventuratour'); // Cambia 'pass' por tu contraseña

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>
