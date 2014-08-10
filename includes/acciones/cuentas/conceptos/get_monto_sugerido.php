<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

$id_modulo = 21; // Cuentas - Nuevo pago
include_once("../../../validar_admin.php");
include_once("../../../clases/class_lib.php");
include_once("../../../validar_acceso.php");
extract($_POST);
# id_concepto

$concepto = new Concepto($id_concepto);
echo $concepto->monto_sugerido;