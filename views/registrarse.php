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
        <h2 class="text-2xl font-semibold mb-6 text-center">Registrar Usuario</h2>
        <form action="../controller/crearUsuarioController.php" method="post">
            <div class="mb-4">
                <label for="nombres" class="block text-lg font-medium mb-2">Nombres</label>
                <input type="text" id="nombres" name="nombres" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="apellidos" class="block text-lg font-medium mb-2">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="Numero_Documento" class="block text-lg font-medium mb-2">No. Documento</label>
                <input type="number" id="Numero_Documento" name="Numero_Documento" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-lg font-medium mb-2">Contraseña</label>
                <input type="password" id="password" name="contraseña" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="rol" class="block text-lg font-medium mb-2">Rol</label>
                <select id="rol" name="rol" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    <option value="estudiante">Estudiante</option>
                    <option value="profesor">Profesor</option>
                    <option value="administrador">Administrador</option>
                </select>
            </div>
            <div class="mb-6">
                <label for="curso" class="block text-lg font-medium mb-2">Curso</label>
                <input type="text" id="curso" name="curso" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg w-full hover:bg-blue-700 transition duration-300">Registrar</button>
        </form>
        <div class="mt-4 text-center">
            <a href="login.php">Ya tienes Cuenta? Inicia Sesion</a>
        </div>
    </div>
</body>

</html>