<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_POST);
# permisos
# id_persona

$admin = new Administrador($id_persona);

$permisos = json_decode(stripslashes($permisos));
$admin->asignarPermisos($permisos);