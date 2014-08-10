<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_GET);
# id_persona

$admin = new Administrador($id_persona);
$modulos = $admin->getModulosPermiso();

$json = array();
if(is_array($modulos))
{
    foreach($modulos as $modulo)
    {
        array_push($json, $modulo['id_modulo']);
    }
}

echo json_encode($json);