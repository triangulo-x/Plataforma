<?php
# Este script inserta una retícula y regresa al usuario a la lista de retículas
# Recibe:
#   - reticulaVal
# Regresa:
#   (Éxito) Redirecciona a /admin/reticulas/index.php
#   (Error al hacer el insert) Redirecciona a /admin/ciclos_escolares/index.php?error=2

include_once("../../clases/class.Reticula.php");
extract($_POST);

if(!isset($reticulaVal)) header('Location: /admin/reticulas/nueva.php?error=1');

if(Reticula::insert($reticulaVal) != 0)
{
    header('Location: /admin/reticulas/index.php');
}
else
{
    header('Location: /admin/reticulas/nueva.php?error=2');
}