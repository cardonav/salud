<?php
include("../../config/db.php");

$action = $_POST['action'] ?? '';

if ($action === 'create') {
    $documento = $conn->real_escape_string($_POST['documento']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $grado = $conn->real_escape_string($_POST['grado']);
    $telefono = $conn->real_escape_string($_POST['telefono']);

    $conn->query("INSERT INTO estudiantes(documento, nombre, grado, telefono) VALUES('$documento', '$nombre', '$grado', '$telefono')");
} elseif ($action === 'update') {
    $id = (int)$_POST['id'];
    $documento = $conn->real_escape_string($_POST['documento']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $grado = $conn->real_escape_string($_POST['grado']);
    $telefono = $conn->real_escape_string($_POST['telefono']);

    $conn->query("UPDATE estudiantes SET documento='$documento', nombre='$nombre', grado='$grado', telefono='$telefono' WHERE id=$id");
}

header("Location: index.php");
exit;
?>