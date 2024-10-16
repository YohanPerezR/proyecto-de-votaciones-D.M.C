<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/images/logo-diegomon.ico" type="image/x-icon">
    <title>Gestión de Candidatos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 ">
<header class="bg-blue-600 text-white py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-bold">Gestión de Estudiantes</h1>
            <nav>
                <a href="../index.html" class="mx-2 hover:underline">Inicio</a>
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
                <form id="candidatoForm">
                    <input type="hidden" id="idCandidato" name="idCandidato">
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
                        <input type="text" id="id_Curso" name="id_Curso" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" placeholder="ID del curso" required>
                    </div>

                    <!-- Imagen -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Imagen:</label>
                        <input type="file" id="imagen" name="imagen" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>

                    <!-- Propuestas -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Propuestas:</label>
                        <textarea id="propuestas" name="propuestas" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" placeholder="Lista de propuestas del candidato" required></textarea>
                    </div>

                    <!-- ID Campaña -->
                    <div class="mb-4">
                        <label class="block text-gray-700">ID Campaña:</label>
                        <input type="text" id="id_Campana" name="id_Campana" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" placeholder="ID de la campaña" required>
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
                        <tr>
                            <td class="py-2 px-4 border-b">1</td>
                            <td class="py-2 px-4 border-b">
                                <img src="ruta-de-imagen.jpg" alt="Candidato" class="h-16 w-16 object-cover rounded-full">
                            </td>
                            <td class="py-2 px-4 border-b">Juan</td>
                            <td class="py-2 px-4 border-b">Pérez</td>
                            <td class="py-2 px-4 border-b">Curso 1</td>
                            <td class="py-2 px-4 border-b">
                                <ul class="list-disc ml-4">
                                    <li>Propuesta 1</li>
                                    <li>Propuesta 2</li>
                                </ul>
                            </td>
                            <td class="py-2 px-4 border-b">Campaña 1</td>
                            <td class="py-2 px-4 border-b flex space-x-2">
                                <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">Editar</button>
                                <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Eliminar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</body>
</html>
