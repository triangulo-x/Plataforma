<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_GET);
# id_persona
# id_ciclo

$alumno = new Alumno($id_persona);
$materias  = $alumno->getMateriasCiclo($id_ciclo);
$area = $alumno->getArea();
$area = new Area($area['id_area']);
$parciales = $area->no_parciales;

$json = array();

if(is_array($materias))
{
    foreach($materias as $materia)
    {
        $materiaARR = array();

        $materiaARR[] = $materia['materia'];

        $promedio = 0;
        for($p = 1; $p <= $parciales; $p++)
        {
            $calificacion = $alumno->getCalificacion($materia['id_clase'], $p);
            $promedio += $calificacion;
            $materiaARR[] = $calificacion;
        }

        $materiaARR[] = $promedio / $parciales;
        $json[] = $materiaARR;
    }
    echo json_encode(array("aaData" => $json));
}