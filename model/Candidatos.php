<?php

require_once("../config/conexion.php");

class Candidatos
{
    private $idCandidato;
    private $Nombres;
    private $Apellidos;
    private $idCurso;
    private $imagen;
    private $Propuestas;
    private $idCampana;

    const TABLA = "candidatos";

    public function __construct($id, $nombres, $apellidos, $curso, $imagen, $propuestas, $campana)
    {
        $this->idCandidato = $id;
        $this->Nombres = $nombres;
        $this->Apellidos = $apellidos;
        $this->idCurso = $curso;
        $this->imagen = $imagen;
        $this->Propuestas = $propuestas;
        $this->idCampana = $campana;
    }

    public function getIdCandidato()
    {
        return $this->idCandidato;
    }

    public function getNombres()
    {
        return $this->Nombres;
    }

    public function getApellidos()
    {
        return $this->Apellidos;
    }

    public function getIdCurso()
    {
        return $this->idCurso;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function getPropuestas()
    {
        return $this->Propuestas;
    }

    public function getIdCampaña()
    {
        return $this->idCampana;
    }

    public function guardar()
    {
        $db = new Conexion();

        $consulta = $db->prepare('INSERT INTO ' . self::TABLA . ' (idCandidato, Nombres, Apellidos, id_Curso, Imagen, Propuestas, id_Campana) VALUES (:idCandidato, :nombres,:apellidos,:id_Curso,:imagen,:propuestas,:id_Campana)');
        $consulta->bindParam(":idCandidato", $this->idCandidato);
        $consulta->bindParam(":nombres", $this->Nombres);
        $consulta->bindParam(":apellidos", $this->Apellidos);
        $consulta->bindParam(":id_Curso", $this->idCurso);
        $consulta->bindParam(":imagen", $this->imagen);
        $consulta->bindParam(":propuestas", $this->Propuestas);
        $consulta->bindParam(":id_Campana", $this->idCampana);
        $consulta->execute();
        $db = null;
    }

    public static function eliminar($idCandidato)
    {
        $db = new Conexion();
        $consulta = $db->prepare('DELETE FROM ' . self::TABLA . ' WHERE idCandidato = :idCandidato');
        $consulta->bindParam(':idCandidato', $idCandidato);
        $consulta->execute();
        $db = null;
    }


    public static function mostrarCandidatosPorAño()
    {
        $db = new Conexion();
        $añoActual = date("Y");
        $consulta = $db->prepare("
        SELECT
        c.idCandidato,
        c.Nombres,
        c.Apellidos,
        c.id_curso,
        c.Imagen,
        c.Propuestas,
        c.Id_Campana,
        cu.Curso as Curso,
        ca.nombre as Campana
        FROM candidatos c
        JOIN cursos cu on c.id_curso = cu.idCursos
        JOIN campana ca on c.id_Campana = ca.id_campana
        WHERE ca.nombre = :anoActual
        ORDER By Nombres ASC
        ");
        $consulta->bindParam(":anoActual", $añoActual);
        $consulta->execute();
        $registros = $consulta->fetchAll();
        $db = null;
        return $registros;
    }

    public static function mostrarCandidatosAdmin()
    {
        $db = new Conexion();

        $consulta = $db->prepare("
        SELECT * FROM candidatos ORDER BY Nombres ASC
        ");
        $consulta->execute();
        $candidatos = $consulta->fetchAll();
        $db = null;
        return $candidatos;
    }
}
