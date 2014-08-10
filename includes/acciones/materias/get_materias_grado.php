<?php
include_once("../../validar_maestro.php");
include_once("../../clases/class_lib.php");
extract($_POST);
# id_grado

$grado = new Grado($id_grado);
$materias = $grado->getMateriasActuales();

if(is_array($materias))
{
    foreach($materias as $materia)
    {
        echo "<option value='".$materia['id_materia']."' >".$materia['materia']."</option>";
    }
}