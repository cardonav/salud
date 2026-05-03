<?php
include("../../config/db.php");
session_start();

if (!isset($_SESSION['u'])) {
    header("Location: ../../login.php");
    exit;
}

$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
    // Optionally delete related history first if there are foreign key constraints
    $conn->query("DELETE FROM historia WHERE estudiante_id=$id");
    $conn->query("DELETE FROM estudiantes WHERE id=$id");
}

header("Location: index.php");
exit;
?>
