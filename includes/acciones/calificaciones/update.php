<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 2/08/14
 * Time: 01:39 PM
 */

include_once("../../validar_maestro.php");
include_once("../../clases/class_lib.php");
extract($_POST);
# parcial
# calificaciones []

$calificaciones = json_decode(stripslashes($calificaciones));

foreach($calificaciones as $calificacion)
{
    $query = "REPLACE INTO calificacion SET
            id_alumno = $calificacion->alumno,
            id_clase = $calificacion->clase,
            parcial = $parcial,
            calificacion = $calificacion->calificacion";
    Database::insert($query);
}

echo 1;