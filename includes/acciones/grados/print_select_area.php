<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_POST);
# area

$area = new Area($area);

$grados = $area->getGrados();

if(is_array($grados))
{
    foreach($grados as $grado)
    {
        echo "<option value='".$grado['id_grado']."' >".$grado['grado']."</option>";
    }
}
else echo 0;