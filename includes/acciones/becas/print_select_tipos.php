<?php
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");

$tipos = Beca::getTipos();

if(is_array($tipos))
{
    foreach($tipos as $tipo)
    {
        echo "<option value='".$tipo['id_tipo_beca']."' >".$tipo['tipo_beca']."</option>";
    }
}
?>