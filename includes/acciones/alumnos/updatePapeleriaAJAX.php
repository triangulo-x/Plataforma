<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 9/05/14
 * Time: 11:31 AM
 */

include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_POST);
# id_alumno
# papeleria

$papeleria = str_replace('\"','"', $papeleria);
$papeleria = json_decode($papeleria);

$alumno = new Alumno($id_alumno);
echo $alumno->setPapeleria($papeleria);