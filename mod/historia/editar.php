<?php
include("../../config/db.php");
include("../../includes/header.php");

$id = (int)($_GET['id'] ?? 0);
$r = $conn->query("SELECT * FROM historia WHERE id=$id");

if ($r->num_rows === 0) {
    echo "<div class='alert alert-danger'>Registro no encontrado.</div>";
    include("../../includes/footer.php");
    exit;
}

$d = $r->fetch_assoc();
$estudiantes = $conn->query("SELECT id, nombre, documento FROM estudiantes ORDER BY nombre ASC");
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex align-items-center mb-4">
            <a href="index.php" class="btn btn-secondary btn-action me-3" title="Volver">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="fw-bold mb-0 text-gradient" style="background: -webkit-linear-gradient(45deg, #06d6a0, #118ab2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Editar Registro Médico</h2>
                <p class="text-light opacity-75">Modifique la información de la atención</p>
            </div>
        </div>

        <div class="glass-card">
            <form method="POST" action="save.php">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" value="<?= $d['id'] ?>">
                
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label text-light opacity-75">Estudiante</label>
                        <select name="estudiante_id" class="form-select glass-input" style="background-color: #1e293b; color: white;" required>
                            <?php while ($e = $estudiantes->fetch_assoc()): ?>
                                <option value="<?= $e['id'] ?>" <?= $e['id'] == $d['estudiante_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($e['nombre']) ?> (Doc: <?= htmlspecialchars($e['documento']) ?>)
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-light opacity-75">Fecha</label>
                        <input type="date" name="fecha" class="form-control glass-input" value="<?= htmlspecialchars($d['fecha']) ?>" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-light opacity-75">Síntomas / Motivo de Consulta</label>
                        <textarea name="sintomas" class="form-control glass-input" rows="3" required><?= htmlspecialchars($d['sintomas']) ?></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-light opacity-75">Tratamiento / Observaciones</label>
                        <textarea name="tratamiento" class="form-control glass-input" rows="3" required><?= htmlspecialchars($d['tratamiento']) ?></textarea>
                    </div>
                </div>
                
                <div class="text-end mt-4">
                    <a href="index.php" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary-custom" style="background: linear-gradient(45deg, #f59e0b, #d97706);">
                        <i class="fa-solid fa-save me-2"></i> Actualizar Registro
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("../../includes/footer.php"); ?>
