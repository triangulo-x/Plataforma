<?php
include("../../validar_admin.php");
include("../../clases/class_lib.php");
extract($_POST);
# id_alumno
# email
# tipo_email

$alumno = new Alumno($id_alumno);
if ($alumno->agregarEmail($email, $tipo_email)) echo 1; else echo 0;
?>