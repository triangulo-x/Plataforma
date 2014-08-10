<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 7/08/14
 * Time: 12:05 PM
 */

include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_POST);
# id_alumno
# id_grupo

$alumno = new Alumno($id_alumno);
$alumno->cambiarGrupo($id_grupo);

echo 1;