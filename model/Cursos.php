<?php

require_once("../config/conexion.php");
class Cursos
{
    private $idCurso;
    private $Curso;

    public function __construct($curso)
    {
        $this->Curso = $curso;
    }

    public static function crearCurso($curso)
    {
        $db = new Conexion();
        $sql = "INSERT INTO cursos (Curso) VALUES (:curso)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':curso', $curso);
        $stmt->execute();
    }

    public static function eliminarCurso($idCurso)
    {
        $db = new Conexion();
        $sql = "DELETE FROM cursos WHERE idCursos = :idCurso";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':idCurso', $idCurso);
        $stmt->execute();
    }

    public static function mostrarCursos()
    {
        $db = new Conexion();
        $sql = "SELECT * FROM cursos";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
