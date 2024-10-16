<?php
require_once("../model/Cursos.php");
require_once("../model/Campañas.php");
require_once("../config/conexion.php");

$cursos = Cursos::mostrarCursos();
$campanas = Campañas::mostrarCampanas();

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
    <title>Gestión de Cursos y Campañas</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.2/jspdf.umd.min.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
    <script src="https://unpkg.com/jspdf-autotable"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .scroll-container {
            max-height: 300px;

            overflow-y: auto;
        }
    </style>
</head>

<body class="bg-gray-100">
    <header class="bg-blue-600 text-white py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-bold">Gestión de Cursos y Campañas</h1>
            <nav>
                <button id="GenerarMysql" class="mx-2 hover:underline">Generar Reporte</button>
                <a href="../views/admin_candidatos.php" class="mx-2 hover:underline">Gestion de Candidatos</a>
                <a href="../views/admin_estudiantes.php" class="mx-2 hover:underline">Gestion de Estudiantes</a>
                <a href="../controller/logout.php" class="mx-2 hover:underline bg-violet-600 px-6 py-2 border rounded-lg text-black transition ease-in-out hover:bg-violet-700 duration-500">Cerrar sesión</a>
            </nav>
        </div>
    </header>

    <div class="container mx-auto mt-8">
        <!-- Gestión de Cursos -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold mb-6 text-center">Gestión de Cursos</h2>
            <div class="flex space-x-4">
                <!-- Formulario de agregar Curso -->
                <div class="w-1/3 bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Agregar Curso</h3>
                    <form action="../controller/crearCurso.php" method="POST">
                        <div class="mb-4">
                            <label class="block text-gray-700">Nombre del Curso:</label>
                            <input type="text" name="curso" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Guardar</button>
                        </div>
                    </form>
                </div>

                <!-- Tabla de Cursos con scroll -->
                <div class="w-2/3 bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Lista de Cursos</h3>
                    <div class="scroll-container">
                        <table class="min-w-full bg-white border">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b">ID Curso</th>
                                    <th class="py-2 px-4 border-b">Curso</th>
                                    <!--<th class="py-2 px-4 border-b">Acciones</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cursos as $curso): ?>
                                    <tr>
                                        <td class="py-2 px-4 border-b text-center"><?php echo $curso['idCursos']; ?></td>
                                        <td class="py-2 px-4 border-b text-center"><?php echo $curso['Curso']; ?></td>
                                        <!--<td class="py-2 px-4 flex space-x-2">-->
                                        <!--
                                            <form action="../controller/eliminarCurso.php" method="POST">
                                                <input type="hidden" name="idCurso" value="<?php echo $curso['idCursos']; ?>">
                                                <button type="submit" class="bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700">Eliminar</button>
                                            </form>
                                            -->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gestión de Campañas -->
        <div>
            <h2 class="text-3xl font-bold mb-6 text-center">Gestión de Campañas</h2>
            <div class="flex space-x-4">
                <!-- Formulario de agregar Campaña -->
                <div class="w-1/3 bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Agregar Campaña</h3>
                    <form action="../controller/crearCampana.php" method="POST">
                        <div class="mb-4">
                            <label class="block text-gray-700">Nombre de la Campaña:</label>
                            <input type="text" name="nombre" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Guardar</button>
                        </div>
                    </form>
                </div>

                <!-- Tabla de Campañas con scroll -->
                <div class="w-2/3 bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Lista de Campañas</h3>
                    <div class="scroll-container">
                        <table class="min-w-full bg-white border">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b">ID Campaña</th>
                                    <th class="py-2 px-4 border-b">Nombre</th>
                                    <!--<th class="py-2 px-4 border-b">Acciones</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($campanas as $campana): ?>
                                    <tr>
                                        <td class="py-2 px-4 border-b text-center"><?php echo $campana['id_campana']; ?></td>
                                        <td class="py-2 px-4 border-b text-center"><?php echo $campana['nombre']; ?></td>
                                        <!--<td class="py-2 px-4 flex space-x-2"> -->
                                        <!--
                                            <form action="../controller/eliminarCampana.php" method="POST">
                                                <input type="hidden" name="idCampana" value="<?php echo $campana['id_campana']; ?>">
                                                <button type="submit" class="bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700">Eliminar</button>
                                            </form>
                                            -->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
</body>

</html>