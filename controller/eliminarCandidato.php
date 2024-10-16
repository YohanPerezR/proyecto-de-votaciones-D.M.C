<?php
require_once("../config/conexion.php");
require_once("../model/Candidatos.php");

if (isset($_POST['idCandidato'])) {
    $idCandidato = $_POST['idCandidato'];

    // Eliminar el candidato
    Candidatos::eliminar($idCandidato);

    // Redirigir después de eliminar, puedes cambiar la URL según sea necesario
    header("Location: ../views/admin_candidatos.php?eliminado=1");
} else {
    // Manejar el caso en que no se reciba el idCandidato
    header("Location: ../views/admin_candidatos.php?error=1");
}
