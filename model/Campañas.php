<?php

require_once("../config/conexion.php");

class Campañas
{
    private $idCampaña;
    private $nombre;

    public function __construct($id, $nombre)
    {
        $this->idCampaña = $id;
        $this->nombre = $nombre;
    }

    public function getIdCampaña()
    {
        return $this->idCampaña;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public static function crearCampana($nombre)
    {
        $db = new Conexion();
        $sql = "INSERT INTO campana (nombre) VALUES (:nombre)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();
    }

    public static function eliminarCampana($idCampana)
    {
        $db = new Conexion();
        $sql = "DELETE FROM campana WHERE id_campana = :idCampana";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':idCampana', $idCampana);
        $stmt->execute();
    }

    public static function mostrarCampanas()
    {
        $db = new Conexion();
        $sql = "SELECT * FROM campana";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
