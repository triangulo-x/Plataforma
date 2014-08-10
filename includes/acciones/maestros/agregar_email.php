<?php
include("../../validar_admin.php");
include("../../clases/class_lib.php");
extract($_POST);
# id_persona
# email
# tipo_email

$maestro = new Maestro($id_maestro);
if ($maestro->agregarEmail($email, $tipo_email)) echo 1; else echo 0;
?>