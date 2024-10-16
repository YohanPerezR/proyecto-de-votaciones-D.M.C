<!DOCTYPE html>
<html lang="en">

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
    <title>Sistema de Votaciones D.M.C</title>
</head>

<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-bold">Sistema de Votaciones D.M.C</h1>
            <nav>
                <a href="#proposito" class="mx-2 hover:underline">Propósito</a>
                <a href="#informacion" class="mx-2 hover:underline">Información</a>
                <a href="#contacto" class="mx-2 hover:underline">Contacto</a>
                <a href="../proyecto-de-votaciones-D.M.C/views/login.php" class="mx-2 hover:underline bg-blue-600 px-6 py-2 border rounded-lg text-black transition ease-in-out hover:bg-blue-700 duration-500  ">Ingresar</a>
            </nav>
        </div>
    </header>
    <?php
    require_once '../proyecto-de-votaciones-D.M.C/config/conexion.php';

    $conexion = new Conexion();
    ?>
    <main class="py-8">
        <section id="proposito" class="bg-white shadow-md rounded-lg p-6 max-w-3xl mx-auto mb-8">
            <h2 class="text-3xl font-semibold mb-4">Bienvenido al Sistema de Votaciones D.M.C</h2>
            <p class="text-lg mb-4">
                Este sistema está diseñado para gestionar el proceso de votaciones en el colegio.
                Aquí podrás votar por tus candidatos favoritos, ver las propuestas de cada uno y conocer los perfiles de los candidatos.
                Los administradores tendrán la capacidad de gestionar y supervisar todas las actividades relacionadas con las votaciones.
            </p>
            <ul class="list-disc list-inside">
                <li><strong>Votaciones:</strong> Participa en las votaciones y elige a tus candidatos preferidos.</li>
                <li><strong>Propuestas:</strong> Consulta las propuestas y programas de los candidatos.</li>
                <li><strong>Perfiles:</strong> Conoce a los candidatos y sus antecedentes.</li>
                <li><strong>Administración:</strong> Los administradores gestionan el sistema y supervisan el proceso.</li>
            </ul>
        </section>

        <section id="informacion" class="bg-white shadow-md rounded-lg p-6 max-w-3xl mx-auto mb-8">
            <h2 class="text-2xl font-semibold mb-4">Información del Colegio</h2>
            <p class="text-lg text-justify ">
                Somos una institución educativa ubicada en Usme, Bogotá, Colombia, con una amplia trayectoria en la formación de jóvenes. Contamos con 2 jornadas, 3 sedes y ofrecemos educación básica primaria, media y una educación para el siglo 21.
                Nuestra misión es formar ciudadanos responsables, críticos y reflexivos, capaces de desempeñarse con éxito en un mundo cambiante y globalizado. Para ello, contamos con un equipo docente altamente capacitado y una metodología de enseñanza basada en la investigación, la creatividad y la tecnología.
                Nuestras instalaciones son modernas y seguras, diseñadas para fomentar el aprendizaje y la convivencia entre los estudiantes. Además, contamos con una amplia gama de actividades extracurriculares, que van desde deportes hasta clubes de lectura, con el objetivo de desarrollar habilidades y talentos en nuestros jóvenes.
                En Colegio Diego Montaña Cuéllar IED valoramos la diversidad y la inclusión, y nos esforzamos por brindar una educación equitativa a todos nuestros estudiantes, independientemente de sus condiciones socioeconómicas.
            </p>
            <hr class="mb-2 mt-2 ">
            <p class="text-lg">
                <strong>Nombre del Colegio:</strong> DIEGO MONTAÑA CUELLAR <br>
                <strong>Dirección:</strong> Transversal 6b # 100c 55 sur <br>
                <strong>Teléfono:</strong> Hay que poner el numero de telefono <br>
                <strong>Email:</strong> Email del colegio <br>
                <strong>pagina del colegio</strong> <a target="_blank" href="https://www.redacademica.edu.co/colegios/colegio-diego-montana-cuellar-ied"> -> Pagina Oficial Del Colegio <- </a>
            </p>

        </section>

    </main>

    <footer class="bg-blue-600 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Sistema de Votaciones. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>

</html>