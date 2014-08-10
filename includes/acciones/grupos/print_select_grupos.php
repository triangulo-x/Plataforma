<?php
include_once("../../clases/class_lib.php");
extract($_POST);
# id_ciclo
# id_grado

$grado = new Grado($id_grado);

$grupos = $grado->getGruposCiclo($id_ciclo);

if(is_array($grupos))
{
    foreach($grupos as $grupo)
    {
        echo "<option value='".$grupo['id_grupo']."' >".$grupo['grupo']."</option>";
    }
}