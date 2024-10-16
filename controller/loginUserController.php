<?php

require_once("../config/conexion.php");
require_once("../model/Usuarios.php");

$db = new Conexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['documento']) &&
        isset($_POST['password'])
    ) {
        $documento = $_POST['documento'];
        $contraseña = $_POST['password'];
        $db = new Conexion();
        Usuarios::login($documento,$contraseña);
    }
}
