<?php
include("../../config/db.php");
include("../../includes/header.php");

// Verificar conexión
if (!$conn) {
    die("Error de conexión a la base de datos");
}

// Consulta segura
$stmt = $conn->prepare("SELECT * FROM estudiantes ORDER BY id DESC");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmacyCare Student - Farmacia Escolar</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.05)" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
            background-size: cover;
            pointer-events: none;
            z-index: 0;
        }

        /* Contenedor principal */
        .container-custom {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        /* Header de farmacia */
        .pharmacy-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 20px 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .pharmacy-icon {
            font-size: 48px;
            color: #667eea;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .pharmacy-title {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
        }

        .student-badge {
            background: linear-gradient(135deg, #F5A623 0%, #E89111 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .pharmacy-slogan {
            color: #7B8A9B;
            font-size: 14px;
            margin: 0;
        }

        .header-stats {
            display: flex;
            gap: 20px;
            justify-content: flex-end;
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
            padding: 10px 20px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 500;
            color: #667eea;
        }

        /* Tarjeta principal */
        .pharmacy-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .pharmacy-card:hover {
            transform: translateY(-5px);
        }

        /* Header de la tarjeta */
        .card-header-modern {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 24px 32px;
            color: white;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .header-content h3 {
            font-size: 24px;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-primary-modern {
            background: white;
            color: #667eea;
            border: none;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary-modern:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            color: #764ba2;
        }

        /* Filtros */
        .filters-bar {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .search-box {
            flex: 1;
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9BA3B2;
        }

        .search-box input {
            width: 100%;
            padding: 10px 16px 10px 45px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50px;
            color: white;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: white;
            background: rgba(255, 255, 255, 0.2);
        }

        .search-box input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .filter-group {
            display: flex;
            gap: 12px;
        }

        .filter-select {
            padding: 10px 20px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50px;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }

        .filter-select option {
            color: #333;
        }

        /* Tabla moderna */
        .table-responsive-modern {
            overflow-x: auto;
        }

        .pharmacy-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pharmacy-table thead th {
            padding: 20px 16px;
            background: #F8F9FA;
            color: #2C3E50;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #E8ECF1;
            text-align: left;
        }

        .pharmacy-table tbody tr {
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .pharmacy-table tbody tr:hover {
            background: #F7F9FC;
            transform: translateX(5px);
        }

        .pharmacy-table td {
            padding: 16px;
            border-bottom: 1px solid #E8ECF1;
            color: #2C3E50;
        }

        /* ID Badge */
        .id-badge {
            font-weight: 700;
            color: #667eea;
        }

        /* Student name con avatar */
        .student-name {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        /* Grade badges */
        .grade-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .grade-6to, .grade-7mo, .grade-8vo {
            background: rgba(74, 144, 226, 0.15);
            color: #4A90E2;
        }

        .grade-9no, .grade-10mo {
            background: rgba(80, 227, 194, 0.15);
            color: #2ECC71;
        }

        .grade-11vo {
            background: rgba(245, 166, 35, 0.15);
            color: #F5A623;
        }

        /* Teléfono */
        .phone-link {
            color: #667eea;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .phone-link:hover {
            text-decoration: underline;
        }

        /* Alertas de alergias */
        .allergy-warning {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #E74C3C;
            background: rgba(231, 76, 60, 0.1);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
        }

        .no-allergy {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #27AE60;
            font-size: 13px;
        }

        /* Botones de acción */
        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .action-btn.view {
            background: rgba(52, 152, 219, 0.1);
            color: #3498DB;
        }

        .action-btn.edit {
            background: rgba(243, 156, 18, 0.1);
            color: #F39C12;
        }

        .action-btn.delete {
            background: rgba(231, 76, 60, 0.1);
            color: #E74C3C;
        }

        .action-btn:hover {
            transform: translateY(-2px);
        }

        /* Botón de emergencia flotante */
        .emergency-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #E74C3C 0%, #C0392B 100%);
            color: white;
            border: none;
            padding: 15px 25px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.4);
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 1000;
            transition: all 0.3s ease;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .emergency-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.6);
        }

        /* Modal de emergencia */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            border-radius: 24px;
            padding: 30px;
            max-width: 500px;
            width: 90%;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-header h3 {
            color: #E74C3C;
            margin: 0;
        }

        .close-modal {
            cursor: pointer;
            font-size: 24px;
            color: #999;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container-custom {
                padding: 10px;
            }
            
            .header-content {
                flex-direction: column;
                align-items: stretch;
            }
            
            .filters-bar {
                flex-direction: column;
            }
            
            .filter-group {
                flex-direction: column;
            }
            
            .header-stats {
                flex-direction: column;
                margin-top: 15px;
            }
            
            .pharmacy-table {
                font-size: 12px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .emergency-btn {
                padding: 10px 20px;
                font-size: 12px;
                bottom: 20px;
                right: 20px;
            }
        }

        /* Animación de búsqueda */
        .search-highlight {
            animation: highlight 0.5s ease;
        }

        @keyframes highlight {
            0% { background: rgba(102, 126, 234, 0.2); }
            100% { background: transparent; }
        }

        /* Texto vacío */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 64px;
            color: #667eea;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state p {
            color: #7B8A9B;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="container-custom">
    <!-- Header de Farmacia -->
    <div class="pharmacy-header">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="logo-area">
                    <i class="fa-solid fa-capsules pharmacy-icon"></i>
                    <div>
                        <h1 class="pharmacy-title">PharmacyCare <span class="student-badge">Student</span></h1>
                        <p class="pharmacy-slogan">Tu salud, nuestra prioridad | Atención escolar</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="header-stats">
                    <div class="stat-card">
                        <i class="fa-solid fa-prescription-bottle"></i>
                        <span>Medicamentos: 245</span>
                    </div>
                    <div class="stat-card">
                        <i class="fa-solid fa-clock"></i>
                        <span>Horario: 7:00 - 16:00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjeta principal -->
    <div class="pharmacy-card">
        <div class="card-header-modern">
            <div class="header-content">
                <div>
                    <h3>
                        <i class="fa-solid fa-clipboard-list"></i>
                        Registro de Estudiantes
                    </h3>
                    <p style="margin-top: 5px; opacity: 0.9;">Gestión de pacientes y seguimiento médico escolar</p>
                </div>
                <a class="btn-primary-modern" href="crear.php">
                    <i class="fa-solid fa-user-plus"></i>
                    Nuevo Estudiante
                </a>
            </div>
            
            <!-- Filtros -->
            <div class="filters-bar">
                <div class="search-box">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" id="searchStudent" placeholder="Buscar por nombre, documento o grado...">
                </div>
                <div class="filter-group">
                    <select class="filter-select" id="filterGrade">
                        <option value="">Todos los grados</option>
                        <option value="6to">6to Grado</option>
                        <option value="7mo">7mo Grado</option>
                        <option value="8vo">8vo Grado</option>
                        <option value="9no">9no Grado</option>
                        <option value="10mo">10mo Grado</option>
                        <option value="11vo">11vo Grado</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="table-responsive-modern">
            <table class="pharmacy-table">
                <thead>
                    <tr>
                        <th><i class="fa-solid fa-hashtag"></i> ID</th>
                        <th><i class="fa-solid fa-id-card"></i> Documento</th>
                        <th><i class="fa-solid fa-user-graduate"></i> Nombre</th>
                        <th><i class="fa-solid fa-graduation-cap"></i> Grado</th>
                        <th><i class="fa-solid fa-phone"></i> Teléfono</th>
                        <th><i class="fa-solid fa-notes-medical"></i> Alergias</th>
                        <th><i class="fa-solid fa-gear"></i> Acciones</th>
                    </tr>
                </thead>
                <tbody id="studentsTable">
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($d = $result->fetch_assoc()): ?>
                            <tr class="student-row" data-grade="<?= htmlspecialchars($d['grado']) ?>" data-name="<?= strtolower(htmlspecialchars($d['nombre'])) ?>" data-doc="<?= htmlspecialchars($d['documento']) ?>">
                                <td class="id-badge">#<?= $d['id'] ?></td>
                                <td><?= htmlspecialchars($d['documento']) ?></td>
                                <td class="student-name">
                                    <div class="avatar">
                                        <?= strtoupper(substr($d['nombre'], 0, 1)) ?>
                                    </div>
                                    <?= htmlspecialchars($d['nombre']) ?>
                                </td>
                                <td>
                                    <span class="grade-badge grade-<?= strtolower(explode(' ', $d['grado'])[0]) ?>">
                                        <?= htmlspecialchars($d['grado']) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="tel:<?= $d['telefono'] ?>" class="phone-link">
                                        <i class="fa-solid fa-phone-volume"></i>
                                        <?= htmlspecialchars($d['telefono']) ?>
                                    </a>
                                </td>
                                <td>
                                    <?php if (!empty($d['alergias'])): ?>
                                        <div class="allergy-warning" title="<?= htmlspecialchars($d['alergias']) ?>">
                                            <i class="fa-solid fa-allergies"></i>
                                            <span><?= substr(htmlspecialchars($d['alergias']), 0, 20) ?>...</span>
                                        </div>
                                    <?php else: ?>
                                        <span class="no-allergy">
                                            <i class="fa-solid fa-check-circle"></i>
                                            Sin alergias
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="ver.php?id=<?= $d['id'] ?>" class="action-btn view" title="Ver ficha médica">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="editar.php?id=<?= $d['id'] ?>" class="action-btn edit" title="Editar">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a href="eliminar.php?id=<?= $d['id'] ?>" class="action-btn delete" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar este estudiante?');">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="empty-state">
                                <i class="fa-solid fa-folder-open"></i>
                                <p>No hay estudiantes registrados.</p>
                                <a href="crear.php" class="btn-primary-modern" style="display: inline-block; margin-top: 15px;">
                                    <i class="fa-solid fa-user-plus"></i> Registrar primer estudiante
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Botón de emergencia -->
<button class="emergency-btn" onclick="openEmergencyModal()">
    <i class="fa-solid fa-ambulance"></i>
    <span>Emergencia Médica</span>
</button>

<!-- Modal de emergencia -->
<div id="emergencyModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa-solid fa-triangle-exclamation"></i> Emergencia Médica</h3>
            <span class="close-modal" onclick="closeEmergencyModal()">&times;</span>
        </div>
        <div class="modal-body">
            <p style="margin-bottom: 20px;">¿Necesitas asistencia médica inmediata?</p>
            <div style="display: flex; gap: 10px; flex-direction: column;">
                <button onclick="callEmergency()" style="background: #E74C3C; color: white; border: none; padding: 12px; border-radius: 10px; cursor: pointer;">
                    <i class="fa-solid fa-phone"></i> Llamar a enfermería (Ext. 123)
                </button>
                <button onclick="closeEmergencyModal()" style="background: #95A5A6; color: white; border: none; padding: 12px; border-radius: 10px; cursor: pointer;">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Búsqueda en tiempo real
    document.getElementById('searchStudent')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('.student-row');
        
        rows.forEach(row => {
            const name = row.getAttribute('data-name') || '';
            const doc = row.getAttribute('data-doc') || '';
            
            if (name.includes(searchTerm) || doc.includes(searchTerm)) {
                row.style.display = '';
                row.classList.add('search-highlight');
                setTimeout(() => row.classList.remove('search-highlight'), 1000);
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Filtro por grado
    document.getElementById('filterGrade')?.addEventListener('change', function(e) {
        const grade = e.target.value;
        const rows = document.querySelectorAll('.student-row');
        
        rows.forEach(row => {
            const rowGrade = row.getAttribute('data-grade') || '';
            if (!grade || rowGrade === grade) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Modal de emergencia
    function openEmergencyModal() {
        document.getElementById('emergencyModal').style.display = 'flex';
    }

    function closeEmergencyModal() {
        document.getElementById('emergencyModal').style.display = 'none';
    }

    function callEmergency() {
        alert('¡Alerta enviada! Enfermería ha sido notificada. Un profesional se dirigirá a tu ubicación.');
        closeEmergencyModal();
    }

    // Cerrar modal al hacer clic fuera
    window.onclick = function(event) {
        const modal = document.getElementById('emergencyModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }

    // Animación al cargar
    document.addEventListener('DOMContentLoaded', () => {
        const rows = document.querySelectorAll('.student-row');
        rows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateX(-20px)';
            setTimeout(() => {
                row.style.transition = 'all 0.3s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateX(0)';
            }, index * 50);
        });
    });
</script>

<?php include("../../includes/footer.php"); ?>
</body>
</html>