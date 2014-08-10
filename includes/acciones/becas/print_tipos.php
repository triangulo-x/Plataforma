<?php
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
$tipos = Beca::getTipos();

if(is_array($tipos))
{
    foreach($tipos as $tipo)
    {
        echo "
            <tr onclick='seleccionarTipo(".$tipo['id_tipo_beca'].", this);' >
                <td>".$tipo['tipo_beca']."</td>
            </tr>
        ";
    }
}
else
{
    echo "<tr><td>No se han agregado tipos de becas</td></tr>";
}
?>