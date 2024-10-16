<?php
require_once("../model/Usuarios.php");
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['ID'])) {
    header("Location:../views/login.php");
    exit();
}

// Verificar si el rol del usuario es Administrador
if ($_SESSION['ROL'] != "Administrador") {
    header("Location:../views/modulo_votacion.php");
    exit();
}

// Verificar si se ha recibido un ID para eliminar
if (isset($_POST['idEstudiante'])) {
    $id = $_POST['idEstudiante'];

    // Llamar al método para eliminar el estudiante
    $resultado = Usuarios::eliminarEstudiante($id);

    // Verificar si la eliminación fue exitosa
    if ($resultado) {
        // Redirigir a la página de gestión de estudiantes con un mensaje de éxito
        header("Location: ../views/admin_estudiantes.php?mensaje=Estudiante eliminado con éxito");
    } else {
        // Redirigir con un mensaje de error
        header("Location: ../views/admin_estudiantes.php?mensaje=Error al eliminar el estudiante");
    }
} else {
    // Si no se proporciona un ID, redirigir con un mensaje de error
    header("Location: ../views/admin_estudiantes.php?mensaje=ID de estudiante no válido");
}
