<?php
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_GET);
# id_telefono

$telefono = new Telefono($id_telefono);
$id_persona = $telefono->id_persona;

if($telefono->eliminar())
{
    header('Location: /admin/alumnos/perfil.php?id_alumno='.$id_persona);
}
else
{
    header('Location: /admin/alumnos/perfil.php?id_alumno='.$id_persona.'&error=2');
}
?>