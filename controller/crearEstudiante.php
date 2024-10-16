<?php
require_once("../model/Usuarios.php");
session_start();

if (!isset($_SESSION['ID'])) {
    $mensaje = "Debes iniciar sesión.";
    header("Location:../views/login.php");
    exit();
}


if ($_SESSION['ROL'] != "Administrador") {
    header("Location:../views/modulo_votacion.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtiene los datos del formulario
    $nombres = $_POST['name']; 
    $apellidos = $_POST['surname']; 
    $documento = $_POST['document']; 
    $contrasena = $_POST['password']; 
    $rol = $_POST['class']; 
    $curso = $_POST['course']; 

    // Crea una instancia del modelo de Usuarios
    $usuario = new Usuarios($documento, $nombres, $apellidos, $contrasena, $rol, $curso);

    // Llama al método guardar para insertar el nuevo estudiante
    $usuario->guardar();

    // Redirecciona a la vista de gestión de estudiantes
    header("Location:../views/admin_estudiantes.php");
    exit();
}
