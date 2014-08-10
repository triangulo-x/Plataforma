<?php
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_POST);
# grado
# area
# materias[]

$materias = json_decode($materias);

if($grado == "" || $area == "")
{
    return 0;
    exit();
}
else
{
    if(Grado::insert($area, $grado, $materias))
    {
        return 1;
        exit();
    }
}