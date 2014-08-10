<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Yozki
 * Date: 14/10/13
 * Time: 01:58 PM
 * To change this template use File | Settings | File Templates.
 */

include_once("class.Database.php");
include_once("class.CicloEscolar.php");

class Estrategia
{
    # Métodos estáticos
    static function insert($estrategia, $id_tema)
    {
        session_start();
        $id_persona = $_SESSION['id_persona'];
        $query = "INSERT INTO planeacion_estrategias SET estrategia = '$estrategia',
            id_tema = $id_tema, fecha = NOW(), id_persona = $id_persona";
        return Database::insert($query);
    }
}