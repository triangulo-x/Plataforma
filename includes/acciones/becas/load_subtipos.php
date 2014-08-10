<?php
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_POST);
# id_tipo

$subtipos = Beca::getSubtipos($id_tipo);

if(is_array($subtipos))
{
    foreach($subtipos as $subtipo)
    {
        echo "<option value='".$subtipo['id_subtipo_beca']."' >".$subtipo['subtipo_beca']."</option>";
    }
}