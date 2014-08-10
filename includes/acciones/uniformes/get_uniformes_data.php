<?php
/**
 * Created by PhpStorm.
 * User: Yozki
 * Date: 2/27/14
 * Time: 3:29 PM
 */

$id_modulo = 41; // Uniformes - Lista
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
include_once("../../validar_acceso.php");

$uniformes = Uniforme::getUniformes();

$json = array();

if(is_array($uniformes))
{
    foreach($uniformes as $uniforme)
    {
        $temp = array();
        array_push($temp, utf8_encode($uniforme['descripcion']));
        array_push($temp, '<img src="/media/iconos/icon_info.png" ALT="VER" onclick="verDatos('.$uniforme['id_uniforme'].')" />');
        array_push($json, $temp);
    }
}

echo json_encode(array("aaData" => $json));