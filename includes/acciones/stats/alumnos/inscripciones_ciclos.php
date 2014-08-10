<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

include_once("../../../validar_admin.php");
include_once("../../../clases/class_lib.php");

$ciclos = CicloEscolar::getInscripciones();

if(is_array($ciclos))
{
    $json = array();
    foreach($ciclos as $ciclo)
    {
        array_push($json, array(ciclo => $ciclo['ciclo'], altas => $ciclo['altas'], bajas => $ciclo['bajas']));
    }
    echo json_encode($json);
}
else
{
    echo json_encode(array(""));
}