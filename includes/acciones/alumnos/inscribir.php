<?php
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_POST);
# id_alumnoVal
# grupoVal

$alumno = new Alumno($id_alumnoVal);
if($alumno->inscribirEnGrupo($grupoVal))
{
    header('Location: /admin/alumnos/alumnos_inscritos.php');
}
else
{
    header('Location: /admin/alumnos/alumnos_inscritos.php?error=1');
}