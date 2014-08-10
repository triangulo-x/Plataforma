<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

include_once("../../validar_maestro.php");
include_once("../../clases/class_lib.php");
$maestro = new Maestro($_SESSION['id_persona']);
extract($_POST);
# id_clase
# faltas[]

$faltas = json_decode(stripslashes($faltas));

if($maestro->teachesClass($id_clase))
{
    if(is_array($faltas))
    {
        foreach($faltas as $falta)
        {
            if(!Falta::insert($falta, $id_clase)) $success = 0;
        }
    }
    echo 1;
}
else echo 0;