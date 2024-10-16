<?php
require_once("../config/conexion.php");

class Usuarios
{
    private $idUsuarios;
    private $Nombres;
    private $Apellidos;
    private $Contrasena;
    private $Rol;
    private $Curso;

    const TABLA = "usuarios";

    public function __construct($id, $nombres, $apellidos, $contrasena, $rol, $curso)
    {
        $this->idUsuarios = $id;
        $this->Nombres = $nombres;
        $this->Apellidos = $apellidos;
        $this->Contrasena = $contrasena;
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

        // Guardar nuevo usuario
        $consulta = $db->prepare('INSERT INTO ' . self::TABLA . ' (idUsuario,Nombres, Apellidos, Contrasena, id_rol, id_curso) VALUES (:idUsuario, :nombres, :apellidos, :contrasena, :rol, :curso)');
        $consulta->bindParam(":idUsuario", $this->idUsuarios);
        $consulta->bindParam(":nombres", $this->Nombres);
        $consulta->bindParam(":apellidos", $this->Apellidos);
        $consulta->bindParam(":contrasena", $this->Contrasena);
        $consulta->bindParam(":rol", $this->Rol);
        $consulta->bindParam(":curso", $this->Curso);
        $consulta->execute();

        $db = null;
    }

    public function editar()
    {
        $db = new Conexion();

        // Editar usuario existente
        $consulta = $db->prepare('UPDATE ' . self::TABLA . ' SET Nombres = :nombres, Apellidos = :apellidos, Contrasena = :contrasena, id_rol = :rol, id_curso = :curso WHERE idUsuario = :idUsuario');
        $consulta->bindParam(":idUsuario", $this->idUsuarios);
        $consulta->bindParam(":nombres", $this->Nombres);
        $consulta->bindParam(":apellidos", $this->Apellidos);
        $consulta->bindParam(":contrasena", $this->Contrasena);
        $consulta->bindParam(":rol", $this->Rol);
        $consulta->bindParam(":curso", $this->Curso);
        $consulta->execute();

        $db = null;
    }

    public static function buscarByID($id)
    {
        $db = new Conexion();

        $consulta = $db->prepare("SELECT
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
        WHERE idUsuario = :id");
        $consulta->bindParam(":id", $id);
        $consulta->execute();
        $registro = $consulta->fetchAll();
        $persona = $registro[0];
        return $persona;
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

            if ($usuario['Rol'] === "Administrador") {
                header("Location:../views/admin_candidatos.php");
                exit();
            } else {
                header("Location:../views/modulo_votacion.php");
                exit();
                mysqli_close($db);
            }
        } else {
            echo "Datos Incorrectos papus";
        }
    }

    public static function obtenerEstudiantes()
    {
        $db = new Conexion();
        $consulta = $db->prepare("
        SELECT
        u.idUsuario,
        u.Nombres,
        u.Apellidos,
        u.Contrasena,
        u.id_rol,
        u.id_curso
        FROM " . self::TABLA . " u
    ");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC); // Devuelve un array asociativo
    }

    public static function eliminarEstudiante($id)
    {
        // Conectar a la base de datos
        $db = new Conexion();

        // Verificar la conexión


        // Preparar y ejecutar la consulta
        $stmt = $db->prepare("DELETE FROM usuarios WHERE idUsuario = :id");
        $stmt->bindParam("id", $id);

        // Ejecutar la consulta
        $resultado = $stmt->execute();

        // Cerrar la conexión
        $db = null;

        // Retornar el resultado de la operación
        return $resultado;
    }


    public static function logout()
    {
        session_destroy();
        header("Location:../index.php");
    }
}
