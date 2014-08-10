<?php
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_POST);
// id_alumno

$alumno = new Alumno($id_alumno);
if(!is_null($alumno))
{
    echo json_encode($alumno);
}
else
{
    echo "error";
}