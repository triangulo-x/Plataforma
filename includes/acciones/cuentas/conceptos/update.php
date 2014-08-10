<?php
$id_modulo = 18; // Cuentas - Modificar concepto
include_once("../../../validar_admin.php");
include_once("../../../clases/class_lib.php");
include_once("../../../validar_acceso.php");
extract($_POST);
# id_conceptoVal
# conceptoVal
# monto_sugeridoVal

$concepto = new Concepto($id_conceptoVal);
$concepto->concepto         = $conceptoVal;
$concepto->monto_sugerido   = $monto_sugeridoVal;

if($concepto->update())
{
    header('Location: /admin/cuentas/conceptos/index.php');
}
else
{
    header('Location: /admin/cuentas/conceptos/modificar.php?id_concepto='.$id_conceptoVal);
}