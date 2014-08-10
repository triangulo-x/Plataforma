<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 30/07/14
 * Time: 03:04 PM
 */

include_once("../../validar_maestro.php");
include_once("../../clases/class_lib.php");
extract($_POST);
# id_grupo
# parcial

session_start();
$id_maestro = $_SESSION['id_persona'];

$grupo = new Grupo($id_grupo);
$alumnos = $grupo->getAlumnos();
$clases = $grupo->getClasesMaestro($id_maestro);

$json = array();

if(is_array($clases))
{
    foreach($clases as $clase)
    {
        $claseOb = new Clase($clase['id_clase']);
        $claseTMP = array();
        $claseTMP['id_clase'] = $claseOb->id_clase;

        $calificacionesTMP = array();
        $calificaciones = $claseOb->getCalificaciones($parcial);
        foreach($calificaciones as $calificacion)
        {
            $calificacionTMP = array();
            $calificacionTMP['alumno'] = $calificacion['id_alumno'];
            $calificacionTMP['calificacion'] = $calificacion['calificacion'];
            $calificacionesTMP[] = $calificacionTMP;
        }
        $claseTMP['calificaciones'] = $calificacionesTMP;
        $json[] = $claseTMP;
    }
}

echo json_encode($json);