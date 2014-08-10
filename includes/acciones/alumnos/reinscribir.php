<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

$id_modulo = 7; // Alumnos - Inscribir
include_once("../../includes/validar_admin.php");
include_once("../../includes/clases/class_lib.php");
include_once("../../includes/validar_acceso.php");
extract($_POST);
# id_alumno
# id_grupo

$alumno = new Alumno($id_alumno);
if($alumno->inscribirEnGrupo($id_grupo)) echo 1;
else echo 2;