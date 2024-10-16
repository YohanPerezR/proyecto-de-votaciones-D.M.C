<?php
session_start();
if (!isset($_SESSION['ID'])) {
    $mensaje = "Debes iniciar sesion.";
    header("Location:../views/login.php");
} else {
    if ($_SESSION['ROL'] != "Administrador") {
        header("Location:../views/modulo_votacion.php");
    }
}

?>
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
    <title>Gestión de Estudiantes - Sistema de Votaciones D.M.C</title>
</head>

<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-bold">Gestión de Estudiantes</h1>
            <nav>
                <a href="../index.html" class="mx-2 hover:underline">Inicio</a>
                <a href="../controller/logout.php" class="mx-2 hover:underline bg-violet-600 px-6 py-2 border rounded-lg text-black transition ease-in-out hover:bg-violet-700 duration-500">Cerrar sesión</a>
            </nav>
        </div>
    </header>

    <main class="py-8">
        <section class="container mx-auto p-6 bg-white shadow-md rounded-lg">
            <h2 class="text-3xl font-semibold mb-6 text-center">Administrar Estudiantes</h2>

            <!-- Formulario para agregar/editar estudiante -->
            <div class="mb-8">
                <form id="studentForm" class="space-y-4">
                    <h3 class="text-2xl font-semibold mb-4">Agregar/Editar Estudiante</h3>
                    <input type="hidden" id="studentId" name="studentId">

                    <label for="name" class="block text-lg font-medium mb-2">Nombres</label>
                    <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded-lg" required>

                    <label for="name" class="block text-lg font-medium mb-2">Apellidos</label>
                    <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded-lg" required>

                    <label for="email" class="block text-lg font-medium mb-2">No.documento</label>
                    <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded-lg" required>

                    <label for="email" class="block text-lg font-medium mb-2">contraseña</label>
                    <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded-lg" required>

                    <label for="class" class="block text-lg font-medium mb-2">Rol</label>
                    <input type="text" id="class" name="class" class="w-full p-2 border border-gray-300 rounded-lg" required>

                    <label for="class" class="block text-lg font-medium mb-2">Curso</label>
                    <input type="text" id="class" name="class" class="w-full p-2 border border-gray-300 rounded-lg" required>

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
                            <th class="py-2 px-4 text-left">Nombre</th>
                            <th class="py-2 px-4 text-left">Email</th>
                            <th class="py-2 px-4 text-left">Clase</th>
                            <th class="py-2 px-4 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="studentTableBody">
                        <!-- Aca es el foreach de php para renderizar los estudiantes -->
                        <tr class="border-b">
                            <td class="py-2 px-4">${student.name}</td>
                            <td class="py-2 px-4">${student.email}</td>
                            <td class="py-2 px-4">${student.class}</td>
                            <td class="py-2 px-4">
                                <button onclick="editStudent(${student.id})" class="bg-yellow-500 text-white py-1 px-2 rounded-lg hover:bg-yellow-600">Editar</button>
                                <button onclick="deleteStudent(${student.id})" class="bg-red-500 text-white py-1 px-2 rounded-lg hover:bg-red-600 ml-2">Eliminar</button>
                            </td>
                        </tr>

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

</body>

</html>