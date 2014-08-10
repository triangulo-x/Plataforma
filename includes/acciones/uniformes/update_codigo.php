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
# codigo

if(!is_null($id_uniforme) || !is_null(codigo))
{
    $uniforme = new Uniforme($id_uniforme);
    echo $uniforme->setCodigo($codigo);
    exit();
}
else
{
    echo "0"; exit();
}