<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 9/01/14
 * Time: 02:36 PM
 */

$id_modulo = 39; // Cuentas - Descuento
include_once("../../../../includes/validar_admin.php");
include_once("../../../../includes/clases/class_lib.php");
include_once("../../../../includes/validar_acceso.php");
extract($_POST);
# id_alumno     int
# id_concepto   int
# monto         double

if(Descuento::insert($id_alumno, $id_concepto, $monto)) echo 1;
else echo 0;