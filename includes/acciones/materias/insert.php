<?php
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_POST);
# materiaVal
# areaVal

if(!isset($materiaVal)){ header('Location: /admin/materias/nueva.php?error=1'); exit(); }

if(Materia::insert($materiaVal, $areaVal)){ header('Location: /admin/materias/index.php'); exit(); }
else { header('Location: /admin/materias/nueva.php?error=2'); exit(); }