<?php
# Este script inserta un ciclo_escolar y regresa al usuario a la lista de ciclos escolares
# Recibe:
#   - fecha_inicioVal
#   - fecha_finVal
# Regresa:
#   (Éxito) Redirecciona a /admin/ciclos_escolares/index.php
#   (Error: Validacion, variables vacias) Redirecciona a /admin/ciclos_escolares/index.php?error=1

$id_modulo = 15; // Ciclos escolares - Nuevo
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
include_once("../../validar_acceso.php");
include_once("../../clases/class.CicloEscolar.php");
extract($_POST);

// Ambas variables tienen contenido
if(!isset($fecha_inicioVal) || !isset($fecha_finVal)) header('Location: /admin/ciclos_escolares/nuevo.php?error=3');

if(CicloEscolar::insert($fecha_inicioVal, $fecha_finVal) != 0)
{
    header('Location: /admin/ciclos_escolares/index.php');
}
else
{
    header('Location: /admin/ciclos_escolares/nuevo.php?error=2');
}