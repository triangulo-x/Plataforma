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
# id_persona
# cantidad
# precio
# id_area

if(is_null($id_uniforme)){ echo "0"; exit(); }
if(is_null($id_persona)){ echo "0"; exit(); }
if(is_null($cantidad)){ echo "0"; exit(); }
if(is_null($id_area)){ echo "0"; exit(); }
if(is_null($precio)){ echo "0"; exit(); }

echo Uniforme::nuevaVenta($id_uniforme, $id_persona, $cantidad, $precio, $id_area);