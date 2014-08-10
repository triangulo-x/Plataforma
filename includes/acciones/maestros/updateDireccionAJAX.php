<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 21/05/14
 * Time: 02:01 PM
 */

$id_modulo = 35; // Maestros - Modificar
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
include_once("../../validar_acceso.php");
extract($_POST);
# id_maestro
# calle
# numero
# colonia
# CP

$maestro = new Maestro($id_maestro);
$maestro->setDireccion($calle, $numero, $colonia, $CP);