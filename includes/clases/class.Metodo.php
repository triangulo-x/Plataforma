<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Yozki
 * Date: 15/10/13
 * Time: 02:49 PM
 * To change this template use File | Settings | File Templates.
 */

class Metodo
{
    # Métodos estáticos
    static function insert($metodo, $id_tema)
    {
        session_start();
        $id_persona = $_SESSION['id_persona'];
        $query = "INSERT INTO planeacion_metodos_ev SET metodo = '$metodo',
            id_tema = $id_tema, fecha = NOW(), id_persona = $id_persona";
        return Database::insert($query);
    }
}