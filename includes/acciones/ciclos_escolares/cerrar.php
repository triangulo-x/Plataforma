<?php
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
$ultimo_ciclo = CicloEscolar::getActual();
if($ultimo_ciclo->cerrar())
{
    header('Location: /index.php');
}
else
{
    header('Location: /admin/ciclos_escolares/cerrar.php?error=1');
}
?>