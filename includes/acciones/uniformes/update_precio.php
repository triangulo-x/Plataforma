<?php
/**
 * Created by PhpStorm.
 * User: Yozki
 * Date: 2/27/14
 * Time: 6:40 PM
 */

include_once("../../clases/class_lib.php");
include_once("../../validar_admin.php");
extract($_POST);
# id_uniforme
# precio

if(!is_null($id_uniforme) || !is_null($precio))
{
    $uniforme = new Uniforme($id_uniforme);
    echo $uniforme->setPrecio($precio);
    exit();
}
else
{
    echo "0"; exit();
}