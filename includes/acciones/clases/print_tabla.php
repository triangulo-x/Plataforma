<?php
include_once("../../clases/class_lib.php");
extract($_POST);

$clases = Clase::getLista();

if(is_array($clases))
{
    foreach($clases as $clase)
    {
        echo "
            <tr>
                <td>".$clase['id_clase']."</td>
                <td>".$clase['grado']."</td>
                <td>".$clase['grupo']."</td>
                <td>".$clase['materia']."</td>
                <td>".$clase['maestro']."</td>
            </tr>
        ";
    }
}