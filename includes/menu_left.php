<?php
switch($_SESSION['tipo_persona'])
{
    case 1: include("menu_alumno.php"); break;
    case 2: include("menu_maestro.php"); break;
    case 3: include("menu_administrador.php"); break;
    default: break;
}
?>
