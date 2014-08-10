<?php
include_once("../../validar_root_admin.php");
include_once("../../clases/class_lib.php");
extract($_GET);
// id_administrador

if($id_administrador == 1 || $id_administrador == 2)
{
    header('Location: /admin/administradores/index.php?error=1');
    exit();
}
else
{
    $administrador = new Administrador($id_administrador);

    if($administrador->delete())
    {
        header('Location: /admin/administradores/index.php');
    }
    else
    {
        header('Location: /admin/administradores/index.php?error=2');
    }
}