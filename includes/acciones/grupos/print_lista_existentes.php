<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 28/07/14
 * Time: 10:57 AM
 */

$id_modulo = 28; // Grupos - Nuevo
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
include_once("../../validar_acceso.php");

extract($_POST);
# id_grado
# id_ciclo

$grado = new Grado($id_grado);
$grupos = $grado->getGruposCiclo($id_ciclo);

if(is_array($grupos))
{
    $primero = TRUE;
    foreach($grupos as $grupo)
    {
        if($primero)
        {
            echo $grupo['grupo'];
            $primero = FALSE;
        }
        else echo ", ".$grupo['grupo'];
    }
}