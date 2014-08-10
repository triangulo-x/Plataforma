<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 24/07/14
 * Time: 01:58 PM
 */

$id_modulo = 18; // Cuentas - Descuentos
include_once("../../../validar_admin.php");
include_once("../../../clases/class_lib.php");
include_once("../../../validar_acceso.php");

extract($_GET);
# ciclo

$descuentos = Cuenta::getDescuentosCiclo($ciclo);

$json = array();

if(is_array($descuentos))
{
    foreach($descuentos as $descuento)
    {
        $temp = array();
        // ID alumno concepto monto fecha id_usuario
        array_push($temp, $descuento['ID']);
        array_push($temp, $descuento['alumno']);
        array_push($temp, $descuento['concepto']);
        array_push($temp, "$".$descuento['monto']);
        array_push($temp, $descuento['fecha']);
        array_push($temp, $descuento['usuario']);
        array_push($json, $temp);
    }
}

echo json_encode(array("aaData" => $json));