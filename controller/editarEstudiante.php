<?php
require_once("../model/Usuarios.php");
session_start();

if (!isset($_SESSION['ID'])) {
    $mensaje = "Debes iniciar sesión.";
    header("Location:../views/login.php");
}

$usuario = new Usuarios(
    $_POST['Numero_Documento'],
    $_POST['nombres'],
    $_POST['apellidos'],
    $_POST['contraseña'],
    $_POST['rol'],
    $_POST['curso']
);


// Llamar al método editar
$usuario->editar();

header("Location: ../views/admin_estudiantes.php"); // Redirigir a la lista de estudiantes
exit();
