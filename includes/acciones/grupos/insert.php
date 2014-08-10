<?php
include_once("../../clases/class_lib.php");
include_once("../../validar_admin.php");
extract($_POST);
# id_gradoVal
# grupoVal
# clases (Arreglo con objetos [id_materia, id_maestro])
# id_ciclo_escolar

if(is_null($id_gradoVal) || is_null($grupoVal))
{
    echo "error";
}
else
{
    $id_grupo = Grupo::insert($grupoVal, $id_gradoVal, $id_ciclo_escolar);

    $clases = json_decode(stripslashes($clases));
    foreach($clases as $clase)
    {
        Clase::insert($id_grupo, $clase->id_materia, $clase->id_maestro);
    }
}
echo 1; // No errores