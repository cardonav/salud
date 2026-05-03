<?php
include("../../config/db.php");
session_start();

if (!isset($_SESSION['u'])) {
    header("Location: ../../login.php");
    exit;
}

$action = $_POST['action'] ?? '';

if ($action === 'create') {
    $estudiante_id = (int)$_POST['estudiante_id'];
    $fecha = $conn->real_escape_string($_POST['fecha']);
    $sintomas = $conn->real_escape_string($_POST['sintomas']);
    $tratamiento = $conn->real_escape_string($_POST['tratamiento']);

    $conn->query("INSERT INTO historia(estudiante_id, fecha, sintomas, tratamiento) VALUES($estudiante_id, '$fecha', '$sintomas', '$tratamiento')");
} elseif ($action === 'update') {
    $id = (int)$_POST['id'];
    $estudiante_id = (int)$_POST['estudiante_id'];
    $fecha = $conn->real_escape_string($_POST['fecha']);
    $sintomas = $conn->real_escape_string($_POST['sintomas']);
    $tratamiento = $conn->real_escape_string($_POST['tratamiento']);

    $conn->query("UPDATE historia SET estudiante_id=$estudiante_id, fecha='$fecha', sintomas='$sintomas', tratamiento='$tratamiento' WHERE id=$id");
}

header("Location: index.php");
exit;
?>
