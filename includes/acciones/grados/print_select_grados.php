<?php
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_POST);
#id_area

$area = new Area($id_area);

$grados = $area->getGrados();

print_r($grados);

if(is_array($grados))
{
    foreach($grados as $grado)
    {
        echo "<option value='".$grado['id_grado']."' >".$grado['grado']."</option>";
    } 
}

?>