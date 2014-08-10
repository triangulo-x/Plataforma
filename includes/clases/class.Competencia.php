<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 14/02/14
 * Time: 01:35 PM
 */

include_once("class.Database.php");

class Competencia
{
    public $id_competencia;
    public $competencia;

    function __construct($_id_competencia)
    {
        $competencia = Database::select("SELECT * FROM competencia WHERE id_competencia = $_id_competencia");
        $competencia = $competencia[0];
        $this->$id_competencia  = $competencia['$id_competencia'];
        $this->$competencia     = $competencia['$competencia'];
    }

    # Métodos estáticos
    public static function getLista()
    {
        return Database::select("SELECT * FROM competencia");
    }

    public static function insert($competencia)
    {
        $query = "INSERT INTO competencia VALUES(null, '$competencia');";
        return Database::insert($query);
    }
} 