<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 25/07/14
 * Time: 03:14 PM
 */

$id_modulo = 28; // Grupos - Nuevo
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
include_once("../../validar_acceso.php");
extract($_POST);
# id_clase
# id_maestro

$clase = new Clase($id_clase);
$clase->id_maestro = $id_maestro;
if($clase->update()) echo 1;