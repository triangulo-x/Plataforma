<?php
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_POST);

CicloEscolar::iniciarNuevo();
$nuevo_ciclo = CicloEscolar::getActual();

echo "success";