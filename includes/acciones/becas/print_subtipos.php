<?php
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_POST);
# id_tipo_beca

$subtipos = Beca::getSubtipos($id_tipo_beca);

if(is_array($subtipos))
{
    foreach($subtipos as $subtipo)
    {
        echo "
            <tr>
                <td>".$subtipo['subtipo_beca']."</td>
            </tr>
        ";
    }
}
else
{
    echo "<tr><td>No se han agregado subtipos</td></tr>";
}