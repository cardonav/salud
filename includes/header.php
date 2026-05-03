<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['u']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
    header("Location: /salud/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COSFA SALUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/salud/assets/css/style.css">
</head>
<body>
    <?php if (isset($_SESSION['u'])): ?>
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/salud/dashboard.php">
                <i class="fa-solid fa-heart-pulse text-danger me-2"></i>COSFA SALUD
            </a>
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/salud/dashboard.php"><i class="fa-solid fa-house me-1"></i> Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/salud/mod/estudiantes/"><i class="fa-solid fa-user-graduate me-1"></i> Estudiantes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/salud/mod/historia/"><i class="fa-solid fa-file-medical me-1"></i> Historia Clínica</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/salud/reportes.php"><i class="fa-solid fa-chart-bar me-1"></i> Reportes</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-danger btn-sm mt-1" href="/salud/logout.php"><i class="fa-solid fa-sign-out-alt me-1"></i> Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php endif; ?>
    <main class="main-content container">
