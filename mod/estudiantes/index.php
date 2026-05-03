<?php
include("../../config/db.php");
include("../../includes/header.php");

$r = $conn->query("SELECT * FROM estudiantes ORDER BY id DESC");
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0 text-gradient">Estudiantes</h2>
        <p class="text-light opacity-75">Gestione el registro de estudiantes</p>
    </div>
    <a class="btn btn-primary-custom" href="crear.php">
        <i class="fa-solid fa-plus me-2"></i> Nuevo Estudiante
    </a>
</div>

<div class="glass-card">
    <div class="table-responsive">
        <table class="table table-hover table-custom mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Grado</th>
                    <th>Teléfono</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($r->num_rows > 0): ?>
                    <?php while ($d = $r->fetch_assoc()): ?>
                        <tr>
                            <td><?= $d['id'] ?></td>
                            <td><?= htmlspecialchars($d['documento']) ?></td>
                            <td class="fw-bold"><?= htmlspecialchars($d['nombre']) ?></td>
                            <td><span class="badge bg-primary bg-opacity-25 text-light border border-primary border-opacity-50"><?= htmlspecialchars($d['grado']) ?></span></td>
                            <td><?= htmlspecialchars($d['telefono']) ?></td>
                            <td class="text-end">
                                <a href="editar.php?id=<?= $d['id'] ?>" class="btn btn-warning btn-action text-dark" title="Editar">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="eliminar.php?id=<?= $d['id'] ?>" class="btn btn-danger btn-action" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar este registro?');">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-light opacity-50">
                            <i class="fa-solid fa-folder-open mb-2 fs-3 d-block"></i>
                            No hay estudiantes registrados.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("../../includes/footer.php"); ?>