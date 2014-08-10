<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

include_once("../../../validar_maestro.php");
include_once("../../../clases/class_lib.php");
extract($_POST);
# id_tema
# estrategiasSeleccionadas

$tema = new Tema($id_tema);

$estrategias = $tema->getEstrategias();
$estrategiasSeleccionadas = json_decode($estrategiasSeleccionadas);

if(is_array($estrategias))
{
    foreach($estrategias as $estrategia)
    {
        $checked = '';
        if(in_array($estrategia['id_estrategia'], $estrategiasSeleccionadas)) $checked = 'checked="checked"';
        echo "
            <tr id='".$estrategia['id_estrategia']."'>
                <td>
                    <input type='checkbox' onclick='estrategiaClicked(this, ".$estrategia['id_estrategia'].");' $checked />
                </td>
                <td>".$estrategia['estrategia']."</td>
            </tr>
        ";
    }
}
else
{
    echo "
        <tr style='text-align: center' >
            <td colspan='2'>El tema <b>".$tema->tema."</b> aún no cuenta con ninguna estrategia registrada.</td>
        </tr>
    ";
}