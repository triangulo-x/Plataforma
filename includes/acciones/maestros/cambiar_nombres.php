<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

$id_modulo = 35; // Maestros - Modificar
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
include_once("../../validar_acceso.php");
extract($_POST);
# nombres
# id_maestro

$maestro = new Maestro($id_maestro);
if($maestro->setNombres($nombres)) echo 1;
else echo 0;