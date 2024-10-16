<?php
require_once("../model/Candidatos.php");
require_once("../model/Cursos.php");
require_once("../model/Campañas.php");
require_once("../config/conexion.php");

session_start();
if (!isset($_SESSION['ID'])) {
    $mensaje = "Debes iniciar sesion.";
    header("Location:../views/login.php");
} else {
    if ($_SESSION['ROL'] != "Administrador") {
        header("Location:../views/modulo_votacion.php");
    }
}

$cursos = Cursos::mostrarCursos();
$campanas = Campañas::mostrarCampanas();
$candidatos = Candidatos::mostrarCandidatosAdmin();

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

$consulta->execute();
$Reportes = $consulta->fetchAll();

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

    <title>Gestión de Candidatos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 ">
    <header class="bg-blue-600 text-white py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-bold">Gestión de Estudiantes</h1>
            <nav>
                <button id="GenerarMysql" class="mx-2 hover:underline">Generar Reporte</button>
                <a href="../views/gestion_cursos_campañas.php" class="mx-2 hover:underline">Gestion de Cursos y Campañas</a>
                <a href="../views/admin_estudiantes.php" class="mx-2 hover:underline">Gestion de Estudiantes</a>
                <a href="../controller/logout.php" class="mx-2 hover:underline bg-violet-600 px-6 py-2 border rounded-lg text-black transition ease-in-out hover:bg-violet-700 duration-500">Cerrar sesión</a>
            </nav>
        </div>
    </header>
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-center mt-8">Gestión de Candidatos</h1>

        <!-- Contenedor principal -->
        <div class="flex space-x-4">
            <!-- Formulario de Agregar/Editar Candidato -->
            <div class="w-1/3 bg-white p-6 rounded-lg shadow-lg">
                <h2 id="form-title" class="text-xl font-bold mb-4">Agregar Candidato</h2>
                <form id="candidatoForm" action="../controller/crearCandidato.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="block text-gray-700">Identificacion del candidato:</label>
                        <input type="text" id="idCandidato" name="idCandidato" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" placeholder="Nombres del candidato" required>
                    </div>
                    <!-- Nombres -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Nombres:</label>
                        <input type="text" id="nombres" name="nombres" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" placeholder="Nombres del candidato" required>
                    </div>

                    <!-- Apellidos -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Apellidos:</label>
                        <input type="text" id="apellidos" name="apellidos" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" placeholder="Apellidos del candidato" required>
                    </div>

                    <!-- ID Curso -->
                    <div class="mb-4">
                        <label class="block text-gray-700">ID Curso:</label>
                        <select id="id_Campana" name="id_Curso" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                            <option value="">Seleccione un Curso</option>
                            <?php foreach ($cursos as $curso): ?>
                                <option value="<?php echo $curso['idCursos']; ?>">
                                    <?php echo $curso['Curso']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Imagen -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Imagen:</label>
                        <input type="file" id="imagen" name="imagen" accept="image/*" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>

                    <!-- Propuestas -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Propuestas:</label>
                        <textarea id="propuestas" name="propuestas" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" placeholder="Lista de propuestas del candidato ASEGURATE DE SEPARARLAS POR COMAS EJ: Hablar,Reir,Saltar" required></textarea>
                    </div>

                    <!-- ID Campaña -->
                    <div class="mb-4">
                        <label class="block text-gray-700">ID Campaña:</label>
                        <select id="id_Campana" name="id_Campana" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                            <option value="">Seleccione una campaña</option>
                            <?php foreach ($campanas as $campana): ?>
                                <option value="<?php echo $campana['id_campana']; ?>">
                                    <?php echo $campana['nombre']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Botón de Guardar -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Guardar</button>
                    </div>
                </form>
            </div>

            <!-- Tabla de Candidatos -->
            <div class="w-2/3 bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold mb-4">Lista de Candidatos</h2>
                <table class="min-w-full bg-white border">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">ID</th>
                            <th class="py-2 px-4 border-b">Imagen</th>
                            <th class="py-2 px-4 border-b">Nombres</th>
                            <th class="py-2 px-4 border-b">Apellidos</th>
                            <th class="py-2 px-4 border-b">ID Curso</th>
                            <th class="py-2 px-4 border-b">Propuestas</th>
                            <th class="py-2 px-4 border-b">ID Campaña</th>
                            <th class="py-2 px-4 border-b">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="candidatoTable">
                        <!-- Aquí se agregan dinámicamente los candidatos -->
                        <?php foreach ($candidatos as $candidato): ?>
                            <?php
                            $imagenBinaria = $candidato['Imagen'];

                            // Detectar el tipo MIME a partir del contenido de la imagen
                            $finfo = finfo_open(FILEINFO_MIME_TYPE);
                            $mimeType = finfo_buffer($finfo, $imagenBinaria); // Detecta si es jpeg, png, gif, etc.
                            finfo_close($finfo);

                            // Convertir la imagen binaria a base64
                            $imagenBase64 = base64_encode($imagenBinaria);
                            ?>
                            <tr>
                                <td class="py-2 px-4 border-b text-center"><?php echo $candidato['idCandidato']; ?></td>
                                <td class="py-2 px-4 border-b text-center">
                                    <img src="data:<?php echo $mimeType; ?>;base64,<?php echo $imagenBase64; ?>" alt="Candidato" class="h-16 w-16 object-cover rounded-full">
                                </td>
                                <td class="py-2 px-4 border-b text-center"><?php echo $candidato['Nombres'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?php echo $candidato['Apellidos'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?php echo $candidato['id_Curso'] ?></td>
                                <td class="py-2 px-4 border-b text-center">
                                    <ul class="list-disc ml-4 text-center">
                                        <li><?php echo $candidato['Propuestas'] ?></li>
                                    </ul>
                                </td>
                                <td class="py-2 px-4  text-center"><?php echo $candidato['id_Campana'] ?></td>
                                <td class="py-2 px-4 flex space-x-2">
                                    <form action="../controller/eliminarCandidato.php" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este candidato?');">
                                        <input type="hidden" name="idCandidato" value="<?= $candidato['idCandidato']; ?>">
                                        <button type="submit" class="bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700"><i class="fa-solid fa-trash-can" style="color: #ffffff;"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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