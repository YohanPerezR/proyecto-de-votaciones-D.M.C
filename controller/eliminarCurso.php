<?php
require_once("../model/Cursos.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idCurso = $_POST['idCurso'] ?? 0;

    if ($idCurso > 0) {
        $cursoEliminado = Cursos::eliminarCurso($idCurso);

        if ($cursoEliminado) {
            header("Location: ../views/gestion_cursos_campañas.php?mensaje=cursoEliminado");
            exit();
        } else {
            header("Location: ../views/gestion_cursos_campañas.php?mensaje=errorEliminarCurso");
            exit();
        }
    } else {
        header("Location: ../views/gestion_cursos_campañas.php?mensaje=idCursoInvalido");
        exit();
    }
}
