<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/images/logo-diegomon.ico" type="image/x-icon">
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
    </script>
    <title>Inicio de Sesión - Sistema de Votaciones D.M.C</title>
</head>

<body class="bg-gray-300 text-gray-800 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-semibold mb-6 text-center">Iniciar Sesión</h2>
        <form action="path_to_your_authentication_script" method="post">
            <div class="mb-4">
                <label for="username" class="block text-lg font-medium mb-2">Nombre de Usuario</label>
                <input type="text" id="username" name="username" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-lg font-medium mb-2">Contraseña</label>
                <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg w-full hover:bg-blue-700 transition duration-300">Iniciar Sesión</button>
        </form>
        <div class="mt-4 text-center">
            <a href="#" class="text-blue-600 hover:underline">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</body>

</html>