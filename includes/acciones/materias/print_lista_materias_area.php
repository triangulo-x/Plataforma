<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

include_once("../../validar_maestro.php");
include_once("../../clases/class_lib.php");
extract($_POST);
# id_area

$materias = Materia::getListaArea($id_area);

if(is_array($materias))
{
    foreach($materias as $materia)
    {
        echo "<li data-id_materia='".$materia['id_materia']."' >".$materia['materia']."</li>";
    }
}