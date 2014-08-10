<?php
include("../../../validar_admin.php");
include_once("../../../clases/class_lib.php");
extract($_GET);
# ciclo_escolar
# concepto

$json = array();

$pagos = Pago::getLista($ciclo_escolar, $concepto);

if(is_array($pagos))
{
    foreach($pagos as $pago)
    {
        $temp = array();
        array_push($temp, $pago['alumno']);
        array_push($temp, $pago['concepto']);
        array_push($temp, $pago['ciclo_escolar']);
        array_push($temp, $pago['fecha']);
        array_push($temp, '$'.$pago['monto']);
        array_push($temp, $pago['usuario']);
        array_push($temp, $pago['descripcion']);
        array_push($temp, '<a href="/admin/cuentas/pagos/imprimr_recibo.php?recibo='.$pago['recibo'].'" >
            <img src="/media/iconos/icon_recibo.png" alt="R" style="width: 14px;" />
                </a>');
        array_push($json, $temp);
    }
}

echo json_encode(array("aaData" => $json));