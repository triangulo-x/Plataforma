<?php
/**
 * Created by PhpStorm.
 * User: Yozki
 * Date: 2/27/14
 * Time: 2:13 PM
 */

include_once("../../clases/class_lib.php");
include_once("../../validar_admin.php");
extract($_POST);
# id_uniforme
# cantidad
# costo

if(is_null($id_uniforme)){ echo "0"; exit(); }
if(is_null($cantidad)){ echo "0"; exit(); }
if(is_null($costo)){ echo "0"; exit(); }

echo Uniforme::nuevaCompra($id_uniforme, $cantidad, $costo);