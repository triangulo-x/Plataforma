<?php
include("../../validar_admin.php");
include("../../clases/class_lib.php");
extract($_POST);
# id_persona

$maestro = new Maestro($id_persona);
if ($maestro->darBaja()) echo 1; else echo 0;
?>