<?php
require_once("../config/conexion.php");

class Usuarios
{
    private $idUsuarios;
    private $Nombres;
    private $Apellidos;
    private $Nodocumento;
    private $Contrasena; // Cambiado de Contraseña a Contrasena
    private $Rol;
    private $Curso;

    const TABLA = "usuarios";

    public function __construct($id, $nombres, $apellidos, $documento, $contrasena, $rol, $curso)
    {
        $this->idUsuarios = $id;
        $this->Nombres = $nombres;
        $this->Apellidos = $apellidos;
        $this->Nodocumento = $documento;
        $this->Contrasena = $contrasena; // Cambiado de Contraseña a Contrasena
        $this->Rol = $rol;
        $this->Curso = $curso;
    }

    public function get_idUsuarios()
    {
        return $this->idUsuarios;
    }
    public function get_Nombres()
    {
        return $this->Nombres;
    }

    public function get_Apellidos()
    {
        return $this->Apellidos;
    }

    public function get_Nodocumento()
    {
        return $this->Nodocumento;
    }

    public function get_Contrasena()
    { // Cambiado de Contraseña a Contrasena
        return $this->Contrasena;
    }
    public function get_Rol()
    {
        return $this->Rol;
    }
    public function get_Curso()
    {
        return $this->Curso;
    }

    public function guardar()
    {
        $db = new Conexion();

        if ($this->idUsuarios) {
            $consulta = $db->prepare('UPDATE ' . self::TABLA  . ' SET Nombres = :nombres, Apellidos = :apellidos, Nodocumento = :documento, Contrasena = :contrasena, Rol = :rol, Curso = :curso WHERE idUsuarios = :idUsuario');
            $consulta->bindParam(":idUsuario", $this->idUsuarios);
            $consulta->bindParam(":nombres", $this->Nombres);
            $consulta->bindParam(":apellidos", $this->Apellidos);
            $consulta->bindParam(":documento", $this->Nodocumento);
            $consulta->bindParam(":contrasena", $this->Contrasena); // Cambiado de Contraseña a Contrasena
            $consulta->bindParam(":rol", $this->Rol);
            $consulta->bindParam(":curso", $this->Curso);
            $consulta->execute();
        } else {
            $consulta = $db->prepare('INSERT INTO ' . self::TABLA . ' (Nombres, Apellidos, Nodocumento, Contrasena, Rol, Curso) VALUES (:nombres,:apellidos,:documento,:contrasena,:rol,:curso)');
            $consulta->bindParam(":nombres", $this->Nombres);
            $consulta->bindParam(":apellidos", $this->Apellidos);
            $consulta->bindParam(":documento", $this->Nodocumento);
            $consulta->bindParam(":contrasena", $this->Contrasena); // Cambiado de Contraseña a Contrasena
            $consulta->bindParam(":rol", $this->Rol);
            $consulta->bindParam(":curso", $this->Curso);
            $consulta->execute();
        }
        $db = null;
    }

    public static function login($documento, $contrasena)
    {
        $db = new Conexion();

        $consulta = $db->prepare("
        SELECT
        u.idUsuario,
        u.Nombres,
        u.Apellidos,
        u.Contrasena,
        u.id_rol,
        u.id_curso,
        r.Nombre as Rol,
        c.Curso as Curso
        FROM usuarios u
        JOIN roles r on u.id_rol = r.idRoles
        JOIN cursos c on u.id_curso = c.idCursos
        WHERE idUsuario = :documento
        ");

        $consulta->bindParam(":documento", $documento);
        $consulta->execute();
        $registro = $consulta->fetchAll();
        $usuario = $registro[0];
        var_dump($usuario['Contrasena']);

        if ($usuario['Contrasena'] ===  $contrasena) {
            session_start();

            $_SESSION['ID'] = $usuario['idUsuario'];
            $_SESSION['NOMBRES'] = $usuario['Nombres'];
            $_SESSION['APELLIDOS'] = $usuario['Apellidos'];
            $_SESSION['IDROL'] = $usuario['id_rol'];
            $_SESSION['IDCURSO'] = $usuario['id_curso'];
            $_SESSION['CURSO'] = $usuario['Curso'];
            $_SESSION['ROL'] = $usuario['Rol'];

            header("Location:../views/modulo_votacion.php");
            exit();
            mysqli_close($db);
        } else {
            echo "Datos Incorrectos papus";
        }
    }

    public static function logout()
    {
        session_destroy();
        header("Location:../index.php");
    }
}
