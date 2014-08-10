<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

include_once("../../../validar_maestro.php");
include_once("../../../clases/class_lib.php");
extract($_POST);
# id_tema
# metodosSeleccionados

$tema = new Tema($id_tema);

$metodos = $tema->getMetodosEvaluacion();
$metodosSeleccionados = json_decode($metodosSeleccionados);

if(is_array($metodos))
{
    foreach($metodos as $metodo)
    {
        $checked = '';
        if(in_array($metodo['id_metodo'], $metodosSeleccionados)) $checked = 'checked="checked"';
        echo "
            <tr id='".$metodo['id_metodo']."'>
                <td>
                    <input type='checkbox' onclick='metodoClicked(this, ".$metodo['id_metodo'].");' $checked />
                </td>
                <td>".$metodo['metodo']."</td>
            </tr>
        ";
    }
}
else
{
    echo "
        <tr style='text-align: center;' >
            <td colspan='2'>El tema <b>".$tema->tema."</b> aún no cuenta con ningun método de evaluación registrado.</td>
        </tr>
    ";
}