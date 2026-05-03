<?php include("includes/header.php"); ?>

<div class="row mb-4">
    <div class="col-12 text-center text-md-start">
        <h2 class="fw-bold mb-0 text-gradient">Panel de Control</h2>
        <p class="text-light opacity-75">Bienvenido al sistema de gestión de COSFA SALUD</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="glass-card text-center h-100 d-flex flex-column justify-content-center">
            <i class="fa-solid fa-user-graduate dash-icon"></i>
            <h4 class="fw-bold">Estudiantes</h4>
            <p class="text-light opacity-75 small mb-4">Gestione el registro y los datos de los estudiantes
                matriculados.</p>
            <a href="mod/estudiantes/" class="btn btn-primary-custom mt-auto">Administrar</a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="glass-card text-center h-100 d-flex flex-column justify-content-center">
            <i class="fa-solid fa-file-medical dash-icon"></i>
            <h4 class="fw-bold">Historia Clínica</h4>
            <p class="text-light opacity-75 small mb-4">Registre y consulte atenciones médicas, síntomas y tratamientos.
            </p>
            <a href="mod/historia/" class="btn btn-primary-custom mt-auto"
                style="background: linear-gradient(45deg, #06d6a0, #118ab2);">
                Administrar
            </a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="glass-card text-center h-100 d-flex flex-column justify-content-center">
            <i class="fa-solid fa-chart-pie dash-icon"></i>
            <h4 class="fw-bold">Reportes</h4>
            <p class="text-light opacity-75 small mb-4">Exporte la información médica a formatos PDF para archivo.</p>
            <a href="reportes.php" class="btn btn-primary-custom mt-auto"
                style="background: linear-gradient(45deg, #ffd166, #f77f00);">
                Generar Reportes
            </a>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>