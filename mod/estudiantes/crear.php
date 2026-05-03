<?php
include("../../includes/header.php");
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex align-items-center mb-4">
            <a href="index.php" class="btn btn-secondary btn-action me-3" title="Volver">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="fw-bold mb-0 text-gradient">Nuevo Estudiante</h2>
                <p class="text-light opacity-75">Ingrese los datos del estudiante</p>
            </div>
        </div>

        <div class="glass-card">
            <form method="POST" action="save.php">
                <input type="hidden" name="action" value="create">
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-light opacity-75">Documento</label>
                        <input name="documento" class="form-control glass-input" placeholder="Ej: 123456789" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light opacity-75">Nombre Completo</label>
                        <input name="nombre" class="form-control glass-input" placeholder="Ej: Juan Pérez" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light opacity-75">Grado</label>
                        <input name="grado" class="form-control glass-input" placeholder="Ej: 10A" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light opacity-75">Teléfono</label>
                        <input name="telefono" class="form-control glass-input" placeholder="Ej: 3001234567">
                    </div>
                </div>
                
                <div class="text-end mt-4">
                    <a href="index.php" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fa-solid fa-save me-2"></i> Guardar Estudiante
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("../../includes/footer.php"); ?>