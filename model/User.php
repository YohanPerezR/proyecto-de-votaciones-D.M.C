<?php 
require_once ("../config/conexion.php");

class Usuarios{
    private $idUsuarios;
    private $Nombres;
    private $Apellidos;
    private $Nodocumento;
    private $Contrasena; // Cambiado de Contraseña a Contrasena
    private $Rol;
    private $Curso;

    const TABLA = "usuarios";

    public function __construct($id, $nombres, $apellidos, $documento, $contrasena, $rol, $curso){
        $this->idUsuarios = $id;
        $this->Nombres = $nombres;
        $this->Apellidos = $apellidos;
        $this->Nodocumento = $documento;
        $this->Contrasena = $contrasena; // Cambiado de Contraseña a Contrasena
        $this->Rol = $rol;
        $this->Curso = $curso;
    }

    public function get_idUsuarios(){
        return $this->idUsuarios;
    }
    public function get_Nombres(){
        return $this->Nombres;
    }

    public function get_Apellidos(){
        return $this->Apellidos;
    }

    public function get_Nodocumento(){
        return $this->Nodocumento;
    }
    
    public function get_Contrasena(){ // Cambiado de Contraseña a Contrasena
        return $this->Contrasena;
    }
    public function get_Rol(){
        return $this->Rol;
    }
    public function get_Curso(){
        return $this->Curso;
    }

    public function guardar(){
        $db = new Conexion();

        if($this->idUsuarios){
            $consulta = $db->prepare('UPDATE ' . self::TABLA  . ' SET Nombres = :nombres, Apellidos = :apellidos, Nodocumento = :documento, Contrasena = :contrasena, Rol = :rol, Curso = :curso WHERE idUsuarios = :idUsuario');
            $consulta->bindParam(":idUsuario",$this->idUsuarios);
            $consulta->bindParam(":nombres",$this->Nombres);
            $consulta->bindParam(":apellidos",$this->Apellidos);
            $consulta->bindParam(":documento",$this->Nodocumento);
            $consulta->bindParam(":contrasena",$this->Contrasena); // Cambiado de Contraseña a Contrasena
            $consulta->bindParam(":rol",$this->Rol);
            $consulta->bindParam(":curso",$this->Curso);
            $consulta->execute();
        }else{
            $consulta = $db->prepare('INSERT INTO '. self::TABLA .' (Nombres, Apellidos, Nodocumento, Contrasena, Rol, Curso) VALUES (:nombres,:apellidos,:documento,:contrasena,:rol,:curso)');
            $consulta->bindParam(":nombres",$this->Nombres);
            $consulta->bindParam(":apellidos",$this->Apellidos);
            $consulta->bindParam(":documento",$this->Nodocumento);
            $consulta->bindParam(":contrasena",$this->Contrasena); // Cambiado de Contraseña a Contrasena
            $consulta->bindParam(":rol",$this->Rol);
            $consulta->bindParam(":curso",$this->Curso);
            $consulta->execute();
        }
        $db = null;
    }

    public function login($documento, $contrasena){
        $db = new Conexion();

        $consulta = $db->prepare("SELECT * FROM ".self::TABLA . " WHERE Nodocumento = :documento");
        $consulta->bindParam(":documento",$documento);
        $consulta->execute();
        $registro = $consulta->fetchAll();
        if($registro['Contrasena'] ===  $contrasena){
            header("Location:../views/modulo_votacion.php");
            exit();
        }else{
            echo "Datos Incorrectos papus";
        }
        
    }

}
