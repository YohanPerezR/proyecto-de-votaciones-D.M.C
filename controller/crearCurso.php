<?php
require_once("../model/Cursos.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $curso = $_POST['curso'] ?? '';

    if (!empty($curso)) {
        $cursoCreado = Cursos::crearCurso($curso);

        if ($cursoCreado) {
            header("Location: ../views/gestion_cursos_campañas.php?mensaje=cursoCreado");
            exit();
        } else {
            header("Location: ../views/gestion_cursos_campañas.php?mensaje=errorCrearCurso");
            exit();
        }
    } else {
        header("Location: ../views/gestion_cursos_campañas.php?mensaje=nombreCursoVacio");
        exit();
    }
}
