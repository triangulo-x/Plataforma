<?php
include("../../validar_admin.php");
include("../../clases/class_lib.php");
extract($_POST);
# id_alumno
# telefono
# tipo_telefono

$alumno = new Alumno($id_alumno);
if ($alumno->agregarTelefono($telefono, $tipo_telefono)) echo 1; else echo 0;