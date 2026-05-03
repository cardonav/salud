<?php
include("../../config/db.php");
session_start();

if (!isset($_SESSION['u'])) {
    header("Location: ../../login.php");
    exit;
}

$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
    $conn->query("DELETE FROM historia WHERE id=$id");
}

header("Location: index.php");
exit;
?>
