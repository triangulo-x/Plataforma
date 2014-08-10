<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 17/01/14
 * Time: 02:21 PM
 * Recibe: (int id_alumno, int id_concepto)
 * Proceso: Solo considera los descuentos que aun no son utilizados
 * Regresa: (int descuento)
 */

$id_modulo = 21; // Cuentas - Nuevo pago
include_once("../../../../includes/validar_admin.php");
include_once("../../../../includes/clases/class_lib.php");
include_once("../../../../includes/validar_acceso.php");
extract($_POST);
# id_alumno     : int
# id_concepto   : int

$alumno = new Alumno($id_alumno);
echo $alumno->getDescuentoAutorizado($id_concepto);