<!DOCTYPE html>
<html lang="es">
<?php




?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/images/logo-diegomon.ico" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

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
    <title>Inicio de Sesión - Sistema de Votaciones D.M.C</title>
    <script>
        window.onload = function() {
            var votoExitoso = <?php echo isset($_GET['voto']) && $_GET['voto'] == 'exitoso' ? 'true' : 'false'; ?>;
            if (votoExitoso) {
                var modal = new bootstrap.Modal(document.getElementById('votoExitosoModal'));
                modal.show();
            }
        }
    </script>
</head>

<body class="bg-gray-300 text-gray-800 flex items-center justify-center min-h-screen">

    <!-- Modal de confirmación -->
    <div class="modal fade" id="votoExitosoModal" tabindex="-1" aria-labelledby="votoExitosoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="votoExitosoModalLabel">Voto Exitoso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¡Tu voto ha sido registrado correctamente!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-semibold mb-6 text-center">Iniciar Sesión</h2>
        <form action="../controller/loginUserController.php" method="post">
            <div class="mb-4">
                <label for="Numero_Documento" class="block text-lg font-medium mb-2">No.Documento</label>
                <input type="number" id="Numero_Documento" name="documento" class="w-full p-2 border border-gray-300 rounded-lg" required>
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
        <div class="mt-4 text-center">
            <a href="./registrarse.php" class="text-blue-600 hover:underline">No tienes cuenta? registrate</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>