<?php
$id_modulo = 19; // Cuentas - Nuevo Concepto
include_once("../../../validar_admin.php");
include_once("../../../clases/class_lib.php");
include_once("../../../validar_acceso.php");
extract($_POST);
# conceptoVal
# monto_sugeridoVal

if(!isset($conceptoVal) || !isset($monto_sugeridoVal))
{
    header('Location: /admin/cuentas/conceptos/nuevo_concepto.php?error=1');
    exit();
}

if(Concepto::insert($conceptoVal, $monto_sugeridoVal))
{
    header('Location: /admin/cuentas/conceptos/index.php');
}
else
{
    header('Location: /admin/cuentas/conceptos/nuevo_concepto.php?error=2');
}