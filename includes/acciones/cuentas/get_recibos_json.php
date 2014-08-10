<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 30/06/14
 * Time: 02:08 PM
 */

$id_modulo = 43; // Cuentas - Re-imprimir recibo
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
include_once("../../validar_acceso.php");

extract($_GET);
# no_recibo
# alumno
# ciclo

$recibos = Pago::getRecibos($no_recibo, $alumno, $ciclo);

$json = array();

if(is_array($recibos))
{
    foreach($recibos as $recibo)
    {
        $temp = array();
        array_push($temp, $recibo['folio']);
        array_push($temp, $recibo['fecha']);
        array_push($temp, $recibo['alumno']);
        array_push($temp, "$".$recibo['total']);
        $link = '<a href="/admin/cuentas/pagos/imprimir_recibo.php?recibo='.$recibo['folio'].'" >
                    <img src="/media/iconos/icon_recibo.png" style="width: 15px" alt="X" /></a>';
        array_push($temp, $link);
        array_push($json, $temp);
    }
}

echo json_encode(array("aaData" => $json));