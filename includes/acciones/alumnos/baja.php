<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

$id_modulo = 37; // Alumnos - Baja
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
include_once("../../validar_acceso.php");
extract($_POST);
# id_persona

$alumno = new Alumno($id_persona);
if($alumno->darBaja()) echo 1;
else echo 0;