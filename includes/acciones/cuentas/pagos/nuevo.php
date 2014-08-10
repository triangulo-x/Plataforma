<?php
$id_modulo = 17; // Cuentas - Pagos
include_once("../../../validar_admin.php");
include_once("../../../clases/class_lib.php");
include_once("../../../validar_acceso.php");
extract($_POST);
# id_persona
# id_concepto
# monto
# descripcion
# pagos [monto, descripcion, forma_pago]
# id_ciclo

if(empty($id_persona)){ echo "error"; exit(); }
if(empty($id_concepto)){ echo "error"; exit(); }
if(empty($monto)){ echo "error"; exit(); }
if(count($pagos) <= 0){ echo "error"; exit(); }

$id_pago = Pago::insert($id_concepto, $id_persona, $monto, $descripcion, $id_ciclo);
if($id_pago)
{
    $pagos = json_decode(stripslashes($pagos));
    $pago = new Pago($id_pago);

    foreach($pagos as $detalle)
    {
        $pago->agregarDetalle($detalle->monto, $detalle->descripcion, $detalle->forma_pago);
    }
}
else
{
    echo "error";
    exit();
}

echo $id_pago; 