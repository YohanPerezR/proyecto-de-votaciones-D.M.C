<?php
require_once("../config/conexion.php");

class Votos
{
    private $idVotos;
    private $id_Usuario;
    private $id_Candidato;
    private $id_Campana;

    const TABLA = "votos";

    public function __construct($idVotos = null, $id_Usuario, $id_Candidato, $id_Campana)
    {
        $this->idVotos = $idVotos;
        $this->id_Usuario = $id_Usuario;
        $this->id_Candidato = $id_Candidato;
        $this->id_Campana = $id_Campana;
    }

    public function get_idVotos()
    {
        return $this->idVotos;
    }

    public function get_id_Usuario()
    {
        return $this->id_Usuario;
    }

    public function get_id_Candidato()
    {
        return $this->id_Candidato;
    }

    public function get_id_Campana()
    {
        return $this->id_Campana;
    }

    public function votar()
    {
        $db = new Conexion();

        $consulta = $db->prepare('INSERT INTO ' . self::TABLA . ' (id_Usuario, id_Candidato, id_Campana) VALUES (:id_Usuario, :id_Candidato, :id_Campana)');
        $consulta->bindParam(":id_Usuario", $this->id_Usuario);
        $consulta->bindParam(":id_Candidato", $this->id_Candidato);
        $consulta->bindParam(":id_Campana", $this->id_Campana);

        $consulta->execute();

        $db = null;
    }

    public static function verificarVoto($id_Usuario, $id_Campana)
    {
        $db = new Conexion();

        $consulta = $db->prepare("SELECT * FROM " . self::TABLA . " WHERE id_Usuario = :id_Usuario AND id_Campana = :id_Campana");
        $consulta->bindParam(":id_Usuario", $id_Usuario);
        $consulta->bindParam(":id_Campana", $id_Campana);

        $consulta->execute();
        $resultado = $consulta->fetch();

        $db = null;
        return $resultado;
    }
}
