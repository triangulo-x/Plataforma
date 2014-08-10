<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

include_once("../../validar_maestro.php");
include_once("../../clases/class_lib.php");

$planeaciones = Plan::getPlaneaciones();

$json = array();

if(is_array($planeaciones))
{
    foreach($planeaciones as $plan)
    {
        $temp = array();
        array_push($temp, $plan['grado']);
        array_push($temp, $plan['materia']);
        array_push($temp, $plan['persona']);
        $link = '<a href="plan.php?id_plan='.$plan['id_plan'].'" ><img src="/media/iconos/icon_profile.png" /></a>';
        array_push($temp, $link);
        array_push($json, $temp);
    }
}

echo json_encode(array("aaData" => $json));