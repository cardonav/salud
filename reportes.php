<?php
include("config/db.php");
include("includes/header.php");
?>

<div class="row justify-content-center">
    <div class="col-md-8 text-center">
        <h2 class="fw-bold mb-4 text-gradient" style="background: -webkit-linear-gradient(45deg, #ffd166, #f77f00); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Reportes</h2>
        <p class="text-light opacity-75 mb-5">Exporte la información de las historias clínicas y estudiantes a formato PDF para impresión o archivo.</p>

        <div class="glass-card p-5">
            <i class="fa-solid fa-file-pdf fa-4x mb-4 text-danger"></i>
            <h4 class="fw-bold">Reporte General de Historias Clínicas</h4>
            <p class="text-muted mb-4" style="color: rgba(255,255,255,0.6)!important;">Genera un documento PDF con todos los registros médicos almacenados en el sistema.</p>
            
            <a href="reporte_pdf.php" target="_blank" class="btn btn-primary-custom btn-lg" style="background: linear-gradient(45deg, #ef476f, #d90429);">
                <i class="fa-solid fa-download me-2"></i> Generar PDF
            </a>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>