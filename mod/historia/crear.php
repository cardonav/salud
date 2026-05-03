<?php
include("../../config/db.php");
include("../../includes/header.php");

$estudiantes = $conn->query("SELECT id, nombre, documento FROM estudiantes ORDER BY nombre ASC");
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex align-items-center mb-4">
            <a href="index.php" class="btn btn-secondary btn-action me-3" title="Volver">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="fw-bold mb-0 text-gradient" style="background: -webkit-linear-gradient(45deg, #06d6a0, #118ab2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Nuevo Registro Médico</h2>
                <p class="text-light opacity-75">Ingrese la información de la atención</p>
            </div>
        </div>

        <div class="glass-card">
            <form method="POST" action="save.php">
                <input type="hidden" name="action" value="create">
                
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label text-light opacity-75">Estudiante</label>
                        <select name="estudiante_id" class="form-select glass-input" style="background-color: #1e293b; color: white;" required>
                            <option value="">Seleccione un estudiante...</option>
                            <?php while ($e = $estudiantes->fetch_assoc()): ?>
                                <option value="<?= $e['id'] ?>"><?= htmlspecialchars($e['nombre']) ?> (Doc: <?= htmlspecialchars($e['documento']) ?>)</option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-light opacity-75">Fecha</label>
                        <input type="date" name="fecha" class="form-control glass-input" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-light opacity-75">Síntomas / Motivo de Consulta</label>
                        <textarea name="sintomas" class="form-control glass-input" rows="3" required></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-light opacity-75">Tratamiento / Observaciones</label>
                        <textarea name="tratamiento" class="form-control glass-input" rows="3" required></textarea>
                    </div>
                </div>
                
                <div class="text-end mt-4">
                    <a href="index.php" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary-custom" style="background: linear-gradient(45deg, #06d6a0, #118ab2);">
                        <i class="fa-solid fa-save me-2"></i> Guardar Registro
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("../../includes/footer.php"); ?>
