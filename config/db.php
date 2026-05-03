<?php
$conn = new mysqli("localhost", "root", "", "cosfa_salud");
if ($conn->connect_error) {
    die("Error de conexión");
}
?>