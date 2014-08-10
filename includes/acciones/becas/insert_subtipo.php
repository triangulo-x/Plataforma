<?php
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_POST);
# id_tipo
# subtipoVal

if(!isset($subtipoVal) || is_null($subtipoVal) || $subtipoVal === ''){ header("Location: /admin/becas/tipos.php?error=1"); exit(); }

if(Beca::insertSubTipo($id_tipo, $subtipoVal))
{
    header("Location: /admin/becas/tipos.php");
}
else
{
    header("Location: /admin/becas/tipos.php?error=2");
}