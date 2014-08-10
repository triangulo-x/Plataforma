<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

$id_modulo = 7; // Alumnos - Inscribir
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
include_once("../../validar_acceso.php");
extract($_POST);
# id_alumno
# calle
# numero
# colonia
# CP

$alumno = new Alumno($id_persona);
$alumno->setDireccion($calle, $numero, $colonia, $CP);