<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

include_once("../../../validar_admin.php");
include_once("../../../clases/class_lib.php");

$ciclos = CicloEscolar::getListaAscendente();

if(is_array($ciclos))
{
    $json = array();
    foreach($ciclos as $ciclo)
    {
        $ciclo_escolar = new CicloEscolar($ciclo['id_ciclo_escolar']);
        array_push($json, array("ciclo" => $ciclo['ciclo_escolar'], "alumnos" => $ciclo_escolar->getCountAlumnosInscritos()));
    }
    echo json_encode($json);
}
else
{
    echo json_encode(array(''));
}