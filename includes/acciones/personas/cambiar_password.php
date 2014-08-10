<?php
include_once("../../validar_sesion.php");
include_once("../../clases/class_lib.php");
extract($_POST);
if(!isset($passwordVal) || !isset($password2Val)) { echo 0; exit(); }
if((strlen($passwordVal) == 0) || strlen($password2Val) == 0) { echo 0; exit(); }

session_start();
switch($_SESSION['tipo_persona'])
{
    case 1:
        $persona = new Alumno($_SESSION['id_persona']);
        break;
    case 2:
        $persona = new Maestro($_SESSION['id_persona']);
        break;
    case 3:
        $persona = new Administrador($_SESSION['id_persona']);
        break;
    default:
        break;
}

if($persona->cambiarPassword($passwordVal))
{
    echo 1; exit();
}
else
{
    echo 0; exit();
}
?>