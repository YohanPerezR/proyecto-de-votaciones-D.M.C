<?php

require_once("../config/conexion.php");
require_once("../model/User.php");

$db = new Conexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['Numero_Documento']) &&
        isset($_POST['password'])
    ) {

        $db = new Conexion();

        $consulta = $db->prepare("SELECT * FROM usuarios WHERE Nodocumento = :documento");
        $consulta->bindParam(":documento", $documento);
        $consulta->execute();
        $registro = $consulta->fetchAll();
        if ($registro['Contrasena'] ===  $contrasena) {
            header("Location:../views/modulo_votacion.php");
            exit();
        } else {
            echo "Datos Incorrectos papus";
        }
    }
}
