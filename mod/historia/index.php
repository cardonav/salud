<?php
include("../../config/db.php");
include("../../includes/header.php");

$query = "SELECT h.*, e.nombre as estudiante_nombre, e.documento as estudiante_documento 
          FROM historia h 
          JOIN estudiantes e ON h.estudiante_id = e.id 
          ORDER BY h.fecha DESC, h.id DESC";
$r = $conn->query($query);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0 text-gradient" style="background: -webkit-linear-gradient(45deg, #06d6a0, #118ab2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Historia Clínica</h2>
        <p class="text-light opacity-75">Gestione los registros médicos de los estudiantes</p>
    </div>
    <a class="btn btn-primary-custom" href="crear.php" style="background: linear-gradient(45deg, #06d6a0, #118ab2);">
        <i class="fa-solid fa-plus me-2"></i> Nuevo Registro
    </a>
</div>

<div class="glass-card">
    <div class="table-responsive">
        <table class="table table-hover table-custom mb-0">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Estudiante</th>
                    <th>Síntomas</th>
                    <th>Tratamiento</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($r && $r->num_rows > 0): ?>
                    <?php while ($d = $r->fetch_assoc()): ?>
                        <tr>
                            <td class="text-nowrap"><i class="fa-regular fa-calendar text-info me-2"></i><?= date('d/m/Y', strtotime($d['fecha'])) ?></td>
                            <td>
                                <div class="fw-bold"><?= htmlspecialchars($d['estudiante_nombre']) ?></div>
                                <div class="small text-light opacity-50">Doc: <?= htmlspecialchars($d['estudiante_documento']) ?></div>
                            </td>
                            <td><?= nl2br(htmlspecialchars(strlen($d['sintomas']) > 50 ? substr($d['sintomas'], 0, 50) . '...' : $d['sintomas'])) ?></td>
                            <td><?= nl2br(htmlspecialchars(strlen($d['tratamiento']) > 50 ? substr($d['tratamiento'], 0, 50) . '...' : $d['tratamiento'])) ?></td>
                            <td class="text-end text-nowrap">
                                <a href="editar.php?id=<?= $d['id'] ?>" class="btn btn-warning btn-action text-dark" title="Editar">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="eliminar.php?id=<?= $d['id'] ?>" class="btn btn-danger btn-action" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar este registro médico?');">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-light opacity-50">
                            <i class="fa-solid fa-file-medical mb-2 fs-3 d-block"></i>
                            No hay historias clínicas registradas.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("../../includes/footer.php"); ?>