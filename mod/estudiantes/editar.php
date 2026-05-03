<?php
include("../../config/db.php");
include("../../includes/header.php");

$id = (int)($_GET['id'] ?? 0);
$r = $conn->query("SELECT * FROM estudiantes WHERE id=$id");

if ($r->num_rows === 0) {
    echo "<div class='alert alert-danger'>Estudiante no encontrado.</div>";
    include("../../includes/footer.php");
    exit;
}

$d = $r->fetch_assoc();
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex align-items-center mb-4">
            <a href="index.php" class="btn btn-secondary btn-action me-3" title="Volver">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="fw-bold mb-0 text-gradient">Editar Estudiante</h2>
                <p class="text-light opacity-75">Modifique los datos del estudiante</p>
            </div>
        </div>

        <div class="glass-card">
            <form method="POST" action="save.php">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" value="<?= $d['id'] ?>">
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-light opacity-75">Documento</label>
                        <input name="documento" class="form-control glass-input" value="<?= htmlspecialchars($d['documento']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light opacity-75">Nombre Completo</label>
                        <input name="nombre" class="form-control glass-input" value="<?= htmlspecialchars($d['nombre']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light opacity-75">Grado</label>
                        <input name="grado" class="form-control glass-input" value="<?= htmlspecialchars($d['grado']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light opacity-75">Teléfono</label>
                        <input name="telefono" class="form-control glass-input" value="<?= htmlspecialchars($d['telefono']) ?>">
                    </div>
                </div>
                
                <div class="text-end mt-4">
                    <a href="index.php" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary-custom" style="background: linear-gradient(45deg, #f59e0b, #d97706);">
                        <i class="fa-solid fa-save me-2"></i> Actualizar Estudiante
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("../../includes/footer.php"); ?>
