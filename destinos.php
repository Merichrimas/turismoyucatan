<?php
require 'database.php';

// Create
function createDestino($nombre, $descripcion, $ubicacion, $precio_estimado) {
    global $mysqli;
    $stmt = $mysqli->prepare("INSERT INTO destinos (nombre, descripcion, ubicacion, precio_estimado) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $nombre, $descripcion, $ubicacion, $precio_estimado);
    $stmt->execute();
    $stmt->close();
}

// Read
function getDestinos() {
    global $mysqli;
    $result = $mysqli->query("SELECT id, nombre, descripcion, ubicacion, precio_estimado FROM destinos");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Delete
function deleteDestino($id) {
    global $mysqli;
    $stmt = $mysqli->prepare("DELETE FROM destinos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
?>
