<?php
/**
 * Created by PhpStorm.
 * User: Yozki
 * Date: 2/15/14
 * Time: 11:04 AM
 */

include_once("../../clases/class_lib.php");
include_once("../../validar_admin.php");
extract($_POST);
# competencia

//$competencia = preg_replace('/\s+/', '', $competencia);
if(strlen($competencia) > 0)
{
    if(Competencia::insert($competencia)) echo 1;
    else echo 0;
}