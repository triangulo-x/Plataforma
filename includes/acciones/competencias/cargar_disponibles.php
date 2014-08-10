<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 14/02/14
 * Time: 01:34 PM
 * Imprime la lista completa de competencias diponibles
 */

include_once("../../clases/class_lib.php");
include_once("../../validar_admin.php");

$competencias = Competencia::getLista();

if(is_array($competencias))
{
    foreach($competencias as $competencia)
    {
        echo "<li class='swappable' value='".$competencia['id_competencia']."' >".$competencia['competencia']."</li>";
    }
}