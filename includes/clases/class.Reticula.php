<?php
include_once("class.Database.php");

class Reticula
{
    public $id_reticula;
    public $reticula;
    public $fecha;

    # Métodos estáticos
    static function getLista()
    {
        return Database::select("SELECT * FROM reticula ORDER BY fecha DESC");
    }

    static function insert($reticula)
    {
        return Database::insert("INSERT INTO reticula SET reticula = '$reticula', fecha = NOW()");
    }

    static function getActual()
    {
        $reticula = Database::select("SELECT id_reticula FROM reticula ORDER BY fecha DESC LIMIT 1;");
        return $reticula[0]['id_reticula'];
    }
}

?>