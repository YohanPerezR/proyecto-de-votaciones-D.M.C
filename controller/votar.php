<?php
require_once("../model/Votos.php");
require_once("../model/Candidatos.php");
session_start();

if (!isset($_SESSION['ID'])) {
    header("Location:../views/login.php");
    exit();
}

// Obtener los valores de la solicitud
$id_Candidato = $_POST['idCandidato'];
$id_Campana = $_POST['idCampana'];
$id_Usuario = $_SESSION['ID'];

// Verificar si el usuario ya ha votado en esta campaña
$votoExistente = Votos::verificarVoto($id_Usuario, $id_Campana);

if ($votoExistente) {
    // Si ya votó, redirigir con mensaje de error
    header("Location:../views/modulo_votacion.php?error=Ya has votado en esta campaña.");
} else {
    // Registrar el voto
    $voto = new Votos(null, $id_Usuario, $id_Candidato, $id_Campana);
    $voto->votar();

    session_destroy();

    // Redirigir al login con un mensaje de confirmación
    header("Location: ../views/login.php?voto=exitoso");
    exit();
}
exit();
