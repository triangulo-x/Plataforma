<?php
include_once("class.Database.php");

class Materia
{
    public $id_materia;
    public $materia;

    # Métodos estáticos
    static function getLista()
    {
        return Database::select("SELECT materia.*, area.area FROM materia
            JOIN area ON materia.id_area = area.id_area");
    }

    static function getListaParametro($parametro)
    {
        return Database::select("SELECT * FROM materia WHERE materia LIKE '%$parametro%'");
    }

    static function getListaArea($id_area)
    {
        return Database::select("SELECT * FROM materia WHERE id_area = $id_area");
    }

    static function insert($materia, $id_area)
    {
        return Database::insert("INSERT INTO materia SET materia = '$materia', id_area = $id_area");
    }
}