<?php
include_once("../../../validar_maestro.php");
include_once("../../../clases/class_lib.php");
extract($_POST);
# id_grado
# id_materia

$temas = Tema::getTema($id_grado, $id_materia);

if(is_array($temas))
{
    foreach($temas as $tema)
    {
        echo "<li class='swappable' id='".$tema['id_tema']."' onclick='temaSeleccionado(this);' >".$tema['tema']."</li>";
    }
}