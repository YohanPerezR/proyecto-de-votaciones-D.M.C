<?php
require_once("../model/Usuarios.php");
require_once("../config/conexion.php");
$id = isset($_GET['id']) ? $_GET['id'] : null;

$db = new Conexion();
$consulta = $db->prepare("SELECT idRoles, Nombre FROM roles");
$consulta->execute();
$roles = $consulta->fetchAll();

$db = null;

$db2 = new Conexion();
$consulta = $db2->prepare("SELECT idCursos, Curso FROM cursos");
$consulta->execute();
$cursos = $consulta->fetchAll();

$estudiante = Usuarios::buscarByID($id);


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/images/logo-diegomon.ico" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/index.css">

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
    </script>
    <title>Registro de Usuario - Sistema de Votaciones D.M.C</title>
</head>

<body class="bg-gray-300 text-gray-800 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-semibold mb-6 text-center">Editar Usuario</h2>
        <form action="../controller/editarEstudiante.php" method="post">
            <div class="mb-4">
                <label for="nombres" class="block text-lg font-medium mb-2">Nombres</label>
                <input type="text" id="nombres" name="nombres" class="w-full p-2 border border-gray-300 rounded-lg" value="<?php echo $estudiante['Nombres']; ?>" required>
            </div>
            <div class="mb-4">
                <label for="apellidos" class="block text-lg font-medium mb-2">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" class="w-full p-2 border border-gray-300 rounded-lg" value="<?php echo $estudiante['Apellidos']; ?>" required>
            </div>
            <div class="mb-4">
                <label for="Numero_Documento" class="block text-lg font-medium mb-2">No. Documento</label>
                <input type="number" id="Numero_Documento" name="Numero_Documento" class="w-full p-2 border border-gray-300 rounded-lg" value="<?php echo $estudiante['idUsuario']; ?>" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-lg font-medium mb-2">Contraseña</label>
                <input type="password" id="password" name="contraseña" class="w-full p-2 border border-gray-300 rounded-lg" value="<?php echo $estudiante['Contrasena']; ?>" required>
            </div>
            <div class="mb-4">
                <label for="rol" class="block text-lg font-medium mb-2">Rol</label>
                <select id="rol" name="rol" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    <option selected value="<?php echo $estudiante['id_rol']; ?>"><?php echo $estudiante['Rol']; ?></option>
                    <?php foreach ($roles as $rol): ?>
                        <option value="<?php echo $rol['idRoles']; ?>"><?php echo $rol['Nombre'] ?></option>>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-6">
                <label for="curso" class="block text-lg font-medium mb-2">Curso</label>
                <select id="curso" name="curso" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    <option selected value="<?php echo $estudiante['id_curso']; ?>"><?php echo $estudiante['Curso']; ?></option>
                    <?php foreach ($cursos as $curso): ?>
                        <option value="<?php echo $curso['idCursos']; ?>"><?php echo $curso['Curso'] ?></option>>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg w-full hover:bg-blue-700 transition duration-300">Guardar</button>
        </form>

    </div>
</body>

</html>