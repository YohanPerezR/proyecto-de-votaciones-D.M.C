<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/logo-diegomon.ico" type="image/x-icon">
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
    <title>Votaciones - Sistema de Votaciones D.M.C</title>
</head>

<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-bold">Sistema de Votaciones D.M.C</h1>
            <nav>
                <a href="index.html" class="mx-2 hover:underline">Inicio</a>
                <a href="#candidatos" class="mx-2 hover:underline">Candidatos</a>
                <a href="#propuestas" class="mx-2 hover:underline">Propuestas</a>
                <a href="views/login.php" class="mx-2 hover:underline bg-violet-600 px-6 py-2 border rounded-lg text-black transition ease-in-out hover:bg-violet-700 duration-500">Ingresar</a>
            </nav>
        </div>
    </header>

    <main class="py-8">
        <section id="candidatos" class="bg-white shadow-md rounded-lg p-6 max-w-6xl mx-auto">
            <h2 class="text-3xl font-semibold mb-6 text-center">Candidatos</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Candidato 1 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                    <img src="assets/images/juan_perez.jpg" alt="Juan Pérez" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-2xl font-semibold mb-2">Juan Pérez</h3>
                    <p class="text-lg mb-2"><strong>Cargo:</strong> Presidente del Consejo Estudiantil</p>
                    <p class="text-lg mb-4"><strong>Biografía:</strong> Juan Pérez es un estudiante de 11º con experiencia en liderazgo estudiantil y una gran pasión por el bienestar de sus compañeros.</p>
                    <p class="text-lg mb-2"><strong>Propuestas:</strong></p>
                    <ul class="list-disc list-inside mb-4">
                        <li>Implementar un programa de tutorías entre pares.</li>
                        <li>Crear un club de emprendimiento estudiantil.</li>
                        <li>Organizar eventos culturales y deportivos mensuales.</li>
                    </ul>
                    <button class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 w-full">Votar por Juan Pérez</button>
                </div>

                <!-- Candidato 2 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                    <img src="assets/images/maria_gomez.jpg" alt="María Gómez" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-2xl font-semibold mb-2">María Gómez</h3>
                    <p class="text-lg mb-2"><strong>Cargo:</strong> Vicepresidente del Consejo Estudiantil</p>
                    <p class="text-lg mb-4"><strong>Biografía:</strong> María Gómez es una estudiante de 10º que ha participado activamente en diversas comisiones estudiantiles y tiene un fuerte compromiso con la inclusión.</p>
                    <p class="text-lg mb-2"><strong>Propuestas:</strong></p>
                    <ul class="list-disc list-inside mb-4">
                        <li>Desarrollar un programa de bienestar mental y emocional.</li>
                        <li>Establecer un consejo de diversidad e inclusión.</li>
                        <li>Promover el reciclaje y la sostenibilidad en la escuela.</li>
                    </ul>
                    <button class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 w-full">Votar por María Gómez</button>
                </div>

                <!-- Candidato 3 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                    <img src="assets/images/carlos_martinez.jpg" alt="Carlos Martínez" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-2xl font-semibold mb-2">Carlos Martínez</h3>
                    <p class="text-lg mb-2"><strong>Cargo:</strong> Secretario del Consejo Estudiantil</p>
                    <p class="text-lg mb-4"><strong>Biografía:</strong> Carlos Martínez es un estudiante de 11º que se destaca en organización de eventos y ha demostrado habilidades sobresalientes en gestión de proyectos.</p>
                    <p class="text-lg mb-2"><strong>Propuestas:</strong></p>
                    <ul class="list-disc list-inside mb-4">
                        <li>Crear un boletín informativo mensual para estudiantes.</li>
                        <li>Organizar ferias de orientación vocacional.</li>
                        <li>Facilitar espacios de comunicación entre estudiantes y administración.</li>
                    </ul>
                    <button class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 w-full">Votar por Carlos Martínez</button>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                    <img src="assets/images/juan_perez.jpg" alt="Juan Pérez" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-2xl font-semibold mb-2">Juan Pérez</h3>
                    <p class="text-lg mb-2"><strong>Cargo:</strong> Presidente del Consejo Estudiantil</p>
                    <p class="text-lg mb-4"><strong>Biografía:</strong> Juan Pérez es un estudiante de 11º con experiencia en liderazgo estudiantil y una gran pasión por el bienestar de sus compañeros.</p>
                    <p class="text-lg mb-2"><strong>Propuestas:</strong></p>
                    <ul class="list-disc list-inside mb-4">
                        <li>Implementar un programa de tutorías entre pares.</li>
                        <li>Crear un club de emprendimiento estudiantil.</li>
                        <li>Organizar eventos culturales y deportivos mensuales.</li>
                    </ul>
                    <button class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 w-full">Votar por Juan Pérez</button>
                </div>
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
