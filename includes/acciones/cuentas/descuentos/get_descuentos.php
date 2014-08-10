<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 9/01/14
 * Time: 10:24 AM
 */

$id_modulo = 39; // Cuentas - Descuento
include_once("../../../../includes/validar_admin.php");
include_once("../../../../includes/clases/class_lib.php");
include_once("../../../../includes/validar_acceso.php");
extract($_GET);
# solo_pendientes: 1 | 0

$descuentos;
switch($solo_pendientes)
{
    case 0: $descuentos = Descuento::getDescuentos(); break;
    case 1: $descuentos = Descuento::getDescuentosPendientes(); break;
}

$json = array();

if(is_array($descuentos))
{
    foreach($descuentos as $descuento)
    {
        $temp = array();
        array_push($temp, $descuento['fecha_autorizacion']);
        array_push($temp, $descuento['fecha_utilizacion']);
        array_push($temp, '$'.$descuento['monto']);
        array_push($temp, $descuento['alumno']);
        array_push($temp, $descuento['concepto']);
        array_push($temp, $descuento['usuario']);
        $link = '<img src="/media/iconos/icon_close.gif" alt="X" onclick="eliminar('.$descuento["id_descuento"].')" />';
        array_push($temp, $link);
        array_push($json, $temp);
    }
}

echo json_encode(array("aaData" => $json));