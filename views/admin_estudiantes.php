<?php
require_once("../model/Usuarios.php");
require_once("../config/conexion.php");
require_once("../model/Cursos.php");
session_start();
$dbReporte = new Conexion();

$consulta = $dbReporte->prepare("SELECT
    COUNT(v.idVotos) AS NumeroVotos,
    c.idCandidato,
    c.Nombres,
    c.Apellidos,
    cu.Curso AS NombreCurso,
    c.Imagen,
    c.Propuestas,
    camp.Nombre AS NombreCampana
FROM
    candidatos c
JOIN
    cursos cu ON c.id_curso = cu.idCursos
JOIN
    campana camp ON c.id_Campana = camp.id_campana
LEFT JOIN
    votos v ON c.idCandidato = v.id_Candidato
GROUP BY
    c.idCandidato, c.Nombres, c.Apellidos, cu.Curso, c.Imagen, c.Propuestas, camp.Nombre
ORDER BY
    camp.Nombre, NumeroVotos DESC");
$cursos = Cursos::mostrarCursos();
$db = new Conexion();
$consulta = $db->prepare("SELECT idRoles, Nombre FROM roles");
$consulta->execute();
$roles = $consulta->fetchAll();
$consulta->execute();
$Reportes = $consulta->fetchAll();

$db = null;
$dbReporte = null;

if (!isset($_SESSION['ID'])) {
    $mensaje = "Debes iniciar sesión.";
    header("Location:../views/login.php");
} else {
    if ($_SESSION['ROL'] != "Administrador") {
        header("Location:../views/modulo_votacion.php");
    }
}

// Obtener estudiantes
$estudiantes = Usuarios::obtenerEstudiantes();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/images/logo-diegomon.ico" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.2/jspdf.umd.min.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
    <script src="https://unpkg.com/jspdf-autotable"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        naranjagod: '#E99210',
                        white: '#ffffff'
                    }
                }
            }
        }

        // Función para redirigir a la vista de edición
        function editStudent(id) {
            window.location.href = `../views/editarEstudiante.php?id=${id}`; // Cambia a la vista de edición
        }

        // Lógica para eliminar estudiante
        function confirmDelete(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este estudiante?')) {
                document.getElementById(`deleteForm${id}`).submit();
            }
        }
    </script>
    <title>Gestión de Estudiantes - Sistema de Votaciones D.M.C</title>
</head>

<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-bold">Gestión de Estudiantes</h1>
            <nav>
                <button id="GenerarMysql" class="mx-2 hover:underline">Generar Reporte</button>
                <a href="../views/admin_candidatos.php" class="mx-2 hover:underline">Gestión de Candidatos</a>
                <a href="../views/gestion_cursos_campañas.php" class="mx-2 hover:underline">Gestión de cursos y campañas</a>
                <a href="../controller/logout.php" class="mx-2 hover:underline bg-violet-600 px-6 py-2 border rounded-lg text-black transition ease-in-out hover:bg-violet-700 duration-500">Cerrar sesión</a>
            </nav>
        </div>
    </header>

    <main class="py-8">
        <section class="container mx-auto p-6 bg-white shadow-md rounded-lg">
            <h2 class="text-3xl font-semibold mb-6 text-center">Administrar Estudiantes</h2>

            <!-- Formulario para agregar estudiante -->
            <div class="mb-8">
                <form id="studentForm" action="../controller/crearEstudiante.php" method="POST" class="space-y-4">
                    <h3 class="text-2xl font-semibold mb-4">Agregar Estudiante</h3>
                    <input type="hidden" id="studentId" name="studentId">

                    <label for="name" class="block text-lg font-medium mb-2">Nombres</label>
                    <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded-lg" required>

                    <label for="surname" class="block text-lg font-medium mb-2">Apellidos</label>
                    <input type="text" id="surname" name="surname" class="w-full p-2 border border-gray-300 rounded-lg" required>

                    <label for="document" class="block text-lg font-medium mb-2">No. documento</label>
                    <input type="text" id="document" name="document" class="w-full p-2 border border-gray-300 rounded-lg" required>

                    <label for="password" class="block text-lg font-medium mb-2">Contraseña</label>
                    <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded-lg" required>

                    <label for="class" class="block text-lg font-medium mb-2">Rol</label>
                    <select id="id_Campana" name="class" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                        <option value="">Seleccione una campaña</option>
                        <?php foreach ($roles as $rol): ?>
                            <option value="<?php echo $rol['idRoles']; ?>">
                                <?php echo $rol['Nombre']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="course" class="block text-lg font-medium mb-2">Curso</label>
                    <select id="id_Campana" name="course" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                        <option value="">Seleccione una campaña</option>
                        <?php foreach ($cursos as $curso): ?>
                            <option value="<?php echo $curso['idCursos']; ?>">
                                <?php echo $curso['Curso']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <div class="flex justify-center">
                        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Guardar</button>
                    </div>
                </form>
            </div>

            <!-- Tabla de estudiantes -->
            <div>
                <h3 class="text-2xl font-semibold mb-4">Lista de Estudiantes</h3>
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead>
                        <tr class="border-b bg-gray-100">
                            <th class="py-2 px-4 text-center">Nombre</th>
                            <th class="py-2 px-4 text-center">Apellidos</th>
                            <th class="py-2 px-4 text-center">Contraseña</th>
                            <th class="py-2 px-4 text-center">Rol</th>
                            <th class="py-2 px-4 text-center">Curso</th>
                            <th class="py-2 px-4 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="studentTableBody">
                        <?php foreach ($estudiantes as $student): ?>
                            <tr class="border-b" data-id="<?= $student['idUsuario'] ?>">
                                <td class="py-2 px-4 text-center"><?= htmlspecialchars($student['Nombres']) ?></td>
                                <td class="py-2 px-4 text-center"><?= htmlspecialchars($student['Apellidos']) ?></td>
                                <td class="py-2 px-4 text-center"><?= htmlspecialchars($student['Contrasena']) ?></td>
                                <td class="py-2 px-4 text-center"><?= htmlspecialchars($student['id_rol']) ?></td>
                                <td class="py-2 px-4 text-center"><?= htmlspecialchars($student['id_curso']) ?></td>
                                <td class="py-2 px-4 flex justify-center space-x-2">
                                    <button onclick="editStudent(<?= $student['idUsuario'] ?>)" class="bg-yellow-500 text-white py-1 px-2 rounded-lg hover:bg-yellow-600">
                                        <i class="fa-solid fa-user-pen" style="color: #ffffff;"></i>
                                    </button>
                                    <form action="../controller/eliminarEstudiante.php" method="POST" class="inline">
                                        <input type="hidden" name="idEstudiante" value="<?php echo $student['idUsuario']; ?>">
                                        <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded-lg hover:bg-red-700">
                                            <i class="fa-solid fa-trash-can" style="color: #ffffff;"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer class="bg-blue-600 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Sistema de Votaciones. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script>
        document.getElementById("GenerarMysql").addEventListener("click", async function() {

            const {
                autoTable
            } = 'jspdf-autotable';
            const {
                jsPDF
            } = window.jspdf;
            const pdf = new jsPDF();
            pdf.text(20, 20, "Reporte de candidatos por votos y por campañas");

            const columns = ["#Votos", "Id", "Nombres", "Apellidos", "Propuestas", "Curso", "Campaña"];
            const data = [];

            <?php foreach ($Reportes as $reporte): ?>
                data.push([
                    <?php echo $reporte['NumeroVotos']; ?>,
                    "<?php echo $reporte['idCandidato']; ?>",
                    "<?php echo $reporte['Nombres']; ?>",
                    "<?php echo $reporte['Apellidos']; ?>",
                    "<?php echo $reporte['Propuestas']; ?>",
                    "<?php echo $reporte['NombreCurso']; ?>",
                    "<?php echo $reporte['NombreCampana']; ?>"
                ]);
            <?php endforeach; ?>

            pdf.autoTable(columns, data, {
                startY: 30,
                margin: {
                    horizontal: 10
                }
            });

            pdf.save('ReporteDeVotos.pdf');
        });
    </script>


    <script src="https://kit.fontawesome.com/c580716ab2.js" crossorigin="anonymous"></script>
</body>

</html>