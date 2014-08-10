<?php
include("../../validar_admin.php");
include("../../clases/class_lib.php");
extract($_POST);
# id_persona
# telefono
# tipo_telefono

$maestro = new Maestro($id_maestro);
if ($maestro->agregarTelefono($telefono, $tipo_telefono)) echo 1; else echo 0;
?>