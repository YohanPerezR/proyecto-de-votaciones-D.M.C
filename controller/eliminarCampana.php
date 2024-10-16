<?php
require_once("../model/Campañas.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idCampana = $_POST['idCampana'] ?? 0;

    if ($idCampana > 0) {
        $campanaEliminada = Campañas::eliminarCampana($idCampana);

        if ($campanaEliminada) {
            header("Location: ../views/gestion_cursos_campañas.php?mensaje=campanaEliminada");
            exit();
        } else {
            header("Location: ../views/gestion_cursos_campañas.php?mensaje=errorEliminarCampana");
            exit();
        }
    } else {
        header("Location: ../views/gestion_cursos_campañas.php?mensaje=idCampanaInvalido");
        exit();
    }
}
