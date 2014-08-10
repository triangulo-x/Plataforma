<?php
include_once("class.Database.php");
include_once("class.CicloEscolar.php");

class Tema
{
    public $id_tema;
    public $tema;
    public $id_grado;
    public $id_materia;
    public $id_persona;

    function __construct($id_tema)
    {
        $tema = Database::select("SELECT * FROM planeacion_temas WHERE id_tema = $id_tema");
        $tema = $tema[0];
        $this->id_tema      = $tema['id_tema'];
        $this->tema         = $tema['tema'];
        $this->id_grado     = $tema['id_grado'];
        $this->id_materia   = $tema['id_materia'];
        $this->id_persona   = $tema['id_persona'];
    }

    function getEstrategias()
    {
        $query = "SELECT * FROM planeacion_estrategias WHERE id_tema = $this->id_tema";
        return Database::select($query);
    }

    function getMetodosEvaluacion()
    {
        $query = "SELECT * FROM planeacion_metodos_ev WHERE id_tema = $this->id_tema";
        return Database::select($query);
    }

    # Métodos estáticos

    static function insert($tema, $id_grado, $id_materia)
    {
        session_start();
        $id_persona = $_SESSION['id_persona'];
        $query = "INSERT INTO planeacion_temas SET
            tema = '$tema', id_grado = '$id_grado', id_materia = '$id_materia', id_persona = $id_persona";
        return Database::insert($query);
    }

    static function getTema($id_grado, $id_materia)
    {
        $query = "SELECT * FROM planeacion_temas
            WHERE id_grado = $id_grado AND id_materia = $id_materia";
        return Database::select($query);
    }
}