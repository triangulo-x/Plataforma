<?php
/**
 * Created by PhpStorm.
 * User: Yozki
 * Date: 30/10/13
 * Time: 02:36 PM
 */
include_once("class.Database.php");

class Tutor
{
    # Métodos estáticos
    static function getTipos()
    {
        $query = "SELECT * FROM tipo_tutor";
        return Database::select($query);
    }
} 