<?php

require_once("../model/Candidatos.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificamos que todos los campos estén presentes
    if (
        isset($_POST['idCandidato']) &&
        isset($_POST['nombres']) &&
        isset($_POST['apellidos']) &&
        isset($_POST['id_Curso']) &&
        isset($_FILES['imagen']) && // Cambiamos de $_POST a $_FILES para la imagen
        isset($_POST['propuestas']) &&
        isset($_POST['id_Campana'])
    ) {
        // Procesamos la imagen subida
        if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
            $imagenBinaria = file_get_contents($_FILES['imagen']['tmp_name']); // Convertimos la imagen a formato binario
        } else {
            echo "Error: No se pudo subir la imagen.";
            exit();
        }

        // Creamos una nueva instancia de Candidatos con la imagen binaria
        $newCandidato = new Candidatos(
            $_POST['idCandidato'],
            $_POST['nombres'],
            $_POST['apellidos'],
            $_POST['id_Curso'],
            $imagenBinaria, // Guardamos la imagen en formato binario
            $_POST['propuestas'],
            $_POST['id_Campana']
        );

        try {
            // Intentamos guardar el candidato en la base de datos
            $newCandidato->guardar();
            header("Location:../views/admin_candidatos.php");
            exit();
        } catch (PDOException $error) {
            echo "Se ha generado un error al guardar el candidato: " . $error->getMessage();
        }
    } else {
        echo "Todos los campos deben estar llenos. :)";
    }
}
