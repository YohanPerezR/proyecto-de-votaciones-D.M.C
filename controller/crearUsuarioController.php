<?php

require_once("../model/User.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['nombres']) &&
        isset($_POST['apellidos']) &&
        isset($_POST['Numero_Documento']) &&
        isset($_POST['contraseña']) &&
        isset($_POST['rol']) &&
        isset($_POST['curso'])
    ) {
        $newUsuario = new Usuarios(
            "",
            $_POST['nombres'],
            $_POST['apellidos'],
            $_POST['Numero_Documento'],
            $_POST['contraseña'],
            $_POST['rol'],
            $_POST['curso']
        );

        try {
            $newUsuario->guardar();
            header("Location:../views/modulo_votacion.php");
            exit();
        } catch (PDOException $error) {
            echo "se genero un error al guardar el usuario, el error es: " . $error->getMessage();
        }
    } else {
        echo "Todos los campos deben estar llenos. :)";
    }
}