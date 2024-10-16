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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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

<script>
    window.onload = function() {
        // Detecta si hay un error en la URL
        var error = new URLSearchParams(window.location.search).get('error');
        var votoExitoso = new URLSearchParams(window.location.search).get('voto');

        if (error) {
            // Mostrar modal con mensaje de error
            document.getElementById('votoModalLabel').innerText = 'Error';
            document.getElementById('votoModalBody').innerText = decodeURIComponent(error);
            var modal = new bootstrap.Modal(document.getElementById('votoModal'));
            modal.show();
        } else if (votoExitoso === 'exitoso') {
            // Mostrar modal de éxito
            document.getElementById('votoModalLabel').innerText = 'Voto Exitoso';
            document.getElementById('votoModalBody').innerText = '¡Tu voto ha sido registrado correctamente!';
            var modal = new bootstrap.Modal(document.getElementById('votoModal'));
            modal.show();
        }
    }
</script>


<body class="bg-gray-100 text-gray-800">

    <!-- Modal de mensaje -->
    <div class="modal fade" id="votoModal" tabindex="-1" aria-labelledby="votoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="votoModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="votoModalBody">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>



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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>