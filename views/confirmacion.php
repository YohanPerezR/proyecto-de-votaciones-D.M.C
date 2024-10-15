<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Voto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="text-center">
        <h1 class="text-2xl font-bold mb-4">Elecciones Estudiantiles</h1>
        <p class="mb-6">Por favor selecciona tu candidato y confirma tu voto.</p>
        <button class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600" onclick="openConfirmation()">Enviar Voto</button>
    </div>

    <!-- Modal de Confirmación -->
    <div id="confirmationModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg text-center">
            <h2 class="text-xl font-bold mb-4">¿Estás seguro?</h2>
            <p class="mb-6">Estás a punto de emitir tu voto. Esta acción no se puede deshacer.</p>
            <div class="flex justify-center space-x-4">
                <button class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600" onclick="submitVote()">Confirmar Voto</button>
                <button class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600" onclick="closeConfirmation()">Cancelar</button>
            </div>
        </div>
    </div>

    <script>
        // Función para abrir la ventana de confirmación
        function openConfirmation() {
            document.getElementById("confirmationModal").classList.remove("hidden");
            document.getElementById("confirmationModal").classList.add("flex");
        }

        // Función para cerrar la ventana de confirmación
        function closeConfirmation() {
            document.getElementById("confirmationModal").classList.remove("flex");
            document.getElementById("confirmationModal").classList.add("hidden");
        }

        // Función para confirmar y enviar el voto
        function submitVote() {
            alert("Tu voto ha sido registrado exitosamente.");
            // Aquí puedes añadir la lógica para enviar el voto al servidor
            closeConfirmation();
        }
    </script>
</body>
</html>
