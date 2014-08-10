<?php
/**
 * Created by PhpStorm.
 * User: Yozki
 * Date: 4/12/13
 * Time: 03:42 PM
 */

class Falta
{
    public $id_alumno;
    public $id_clase;
    public $fecha;

    /** Métodos estáticos */
    public static function insert($id_alumno, $id_clase)
    {
        $query = "INSERT INTO falta SET id_alumno = $id_alumno, id_clase = $id_clase, fecha = NOW();";
        return Database::insert($query);
    }
}