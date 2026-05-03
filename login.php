<?php
session_start();
if (isset($_SESSION['u'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include("config/db.php");
    $u = $conn->real_escape_string($_POST['u']);
    $p = $_POST['p'];

    $r = $conn->query("SELECT * FROM usuarios WHERE username='$u'");
    $d = $r->fetch_assoc();

    // Check plaintext (for existing DB entry '1234') or hashed password
    if ($d && ($p === $d['password'] || password_verify($p, $d['password']))) {
        $_SESSION['u'] = $u;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - COSFA SALUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
        }
        .logo-circle {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: -60px auto 20px;
            box-shadow: 0 10px 20px rgba(247, 37, 133, 0.3);
            font-size: 2rem;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="glass-card text-center mt-5">
            <div class="logo-circle">
                <i class="fa-solid fa-heart-pulse"></i>
            </div>
            <h2 class="fw-bold mb-1">COSFA SALUD</h2>
            <p class="text-muted mb-4" style="color: rgba(255,255,255,0.6)!important;">Sistema de Gestión Médica</p>

            <?php if ($error): ?>
                <div class="alert alert-danger" style="background: rgba(220,53,69,0.2); border: 1px solid rgba(220,53,69,0.5); color: #ffb3b3;">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3 text-start">
                    <label class="form-label text-light opacity-75">Usuario</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 border-light border-opacity-10 text-light">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <input name="u" class="form-control glass-input border-start-0 ps-0" placeholder="Ej: admin" required>
                    </div>
                </div>
                <div class="mb-4 text-start">
                    <label class="form-label text-light opacity-75">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 border-light border-opacity-10 text-light">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input name="p" type="password" class="form-control glass-input border-start-0 ps-0" placeholder="••••••••" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary-custom w-100">
                    <i class="fa-solid fa-arrow-right-to-bracket me-2"></i> Ingresar
                </button>
            </form>
        </div>
    </div>
</body>
</html>