<?php
include_once("class.Database.php");

class Beca
{
    # Métodos estáticos
    public static function getTipos()
    {
        return Database::select("SELECT * FROM beca_tipo");
    }

    public static function insertTipo($tipo)
    {
        $query = "INSERT INTO beca_tipo SET tipo_beca = '$tipo'";
        return Database::insert($query);
    }

    public static function getSubtipos($id_tipo)
    {
        $query = "SELECT * FROM beca_subtipo WHERE id_tipo_beca = $id_tipo";
        return Database::select($query);
    }

    public static function insertSubTipo($id_tipo_beca, $subtipo_beca)
    {
        $query = "INSERT INTO beca_subtipo SET id_tipo_beca = $id_tipo_beca, subtipo_beca = '$subtipo_beca'";
        return Database::insert($query);
    }
}