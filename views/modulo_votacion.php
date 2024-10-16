<!DOCTYPE html>
<html lang="es">
<?php
require_once("../model/Candidatos.php");
session_start();
if (!isset($_SESSION['ID'])) {
    $mensaje = "Debes iniciar sesion.";
    header("Location:../views/login.php");
}

$candidatos = Candidatos::mostrarCandidatosPorAño();


?>

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
    <title>Votaciones - Sistema de Votaciones D.M.C</title>
</head>

<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-bold">Sistema de Votaciones D.M.C</h1>
            <div>
                <?php echo $_SESSION['NOMBRES'] . " " . $_SESSION['APELLIDOS'] . " Con el rol de " . $_SESSION['ROL']; ?>
            </div>
            <nav>
                <!--
                <a href="index.html" class="mx-2 hover:underline">Inicio</a>
                <a href="#candidatos" class="mx-2 hover:underline">Candidatos</a>
                <a href="#propuestas" class="mx-2 hover:underline">Propuestas</a>
                <a href="login.php" class="mx-2 hover:underline bg-violet-600 px-6 py-2 border rounded-lg text-black transition ease-in-out hover:bg-violet-700 duration-500">Ingresar</a>
                -->
                <a href="../controller/logout.php" class="mx-2 hover:underline">Cerrar Session</a>
            </nav>
        </div>
    </header>

    <main class="py-8">
        <section id="candidatos" class="bg-white shadow-md rounded-lg p-6 max-w-6xl mx-auto">
            <h2 class="text-3xl font-semibold mb-6 text-center">Candidatos</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Candidato 1 -->
                <?php foreach ($candidatos as $candidato): ?>
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                        <?php $imagenBase64 = base64_encode($candidato['Imagen']); ?>
                        <img src="data:image/jpeg;base64,<?php echo $imagenBase64; ?>" alt="Imagen de <?php echo $candidato['Nombres']; ?>" class="w-full h-48 object-cover rounded-lg mb-4">
                        <h3 class="text-2xl font-semibold mb-2"><?php echo $candidato['Nombres'] . " " . $candidato['Apellidos']; ?></h3>
                        <p class="text-lg mb-2"><strong>Curso:</strong> <?php echo $candidato['Curso']; ?></p>
                        <p class="text-lg mb-2"><strong>Campaña:</strong> <?php echo $candidato['Campana']; ?></p>
                        <p class="text-lg mb-2"><strong>Propuestas:</strong></p>
                        <ul class="list-disc list-inside mb-4">
                            <?php
                            $propuestas = explode(",", $candidato['Propuestas']);
                            foreach ($propuestas as $propuesta): ?>
                                <li><?php echo trim($propuesta); ?></li>
                            <?php endforeach; ?>
                        </ul>

                        <!-- Formulario para votar -->
                        <form action="../controller/votar.php" method="POST">
                            <input type="hidden" name="idCandidato" value="<?php echo $candidato['idCandidato']; ?>">
                            <input type="hidden" name="idCampana" value="<?php echo $candidato['Id_Campana']; ?>">
                            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 w-full">
                                Votar por <?php echo $candidato['Nombres']; ?>
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>



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