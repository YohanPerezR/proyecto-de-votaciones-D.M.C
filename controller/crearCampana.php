<?php
require_once("../model/Campañas.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'] ?? '';

    if (!empty($nombre)) {
        $campanaCreada = Campañas::crearCampana($nombre);

        if ($campanaCreada) {
            header("Location: ../views/gestion_cursos_campañas.php?mensaje=campanaCreada");
            exit();
        } else {
            header("Location: ../views/gestion_cursos_campañas.php?mensaje=errorCrearCampana");
            exit();
        }
    } else {
        header("Location: ../views/gestion_cursos_campañas.php?mensaje=nombreCampanaVacio");
        exit();
    }
}
