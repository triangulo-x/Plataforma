<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

include_once("../../../validar_admin.php");
include_once("../../../clases/class_lib.php");
extract($_GET);
# tipo // Tipo de gráfica

$ciclo = CicloEscolar::getActual();

$dist = $ciclo->getDistribucionAlumnos();
// id_area | alumnos

function barra()
{
    global $dist;
    $arr = array();
    array_push($arr, $dist[0]['A1']);
    array_push($arr, $dist[0]['A2']);
    array_push($arr, $dist[0]['A3']);
    array_push($arr, $dist[0]['A4']);
    array_push($arr, $dist[0]['A5']);
    echo json_encode($arr);
}

function pie()
{
    global $dist;
    $arr = array();
    array_push($arr, array("value" => $dist[0]['A1'], "color" => "#A3A3FA"));
    array_push($arr, array("value" => $dist[0]['A2'], "color" => "#FF7373"));
    array_push($arr, array("value" => $dist[0]['A3'], "color" => "#8BFF8B"));
    array_push($arr, array("value" => $dist[0]['A4'], "color" => "#FFFB9B"));
    array_push($arr, array("value" => $dist[0]['A5'], "color" => "#D873FF"));
    echo json_encode($arr);
}

if(is_array($dist))
{
    global $tipo;
    switch($tipo)
    {
        case 1: barra(); break;
        case 2: pie(); break;
        default: echo json_encode(array(0, 0, 0, 0, 0)); break;
    }
}
else
{
    echo json_encode(array(0, 0, 0, 0, 0));
}
