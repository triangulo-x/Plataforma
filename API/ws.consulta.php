<?php
include_once("../includes/clases/class_lib.php");
extract($_POST);
# matricula
# password
    
$alumno = Persona::login($matricula, $password);
if($alumno->id_persona != 0)
{
    $materias = $alumno->getMateriasCursando();

    $JSONmaterias = array();
    $promedio_final = 0;
    $calificadas = 0;
    if(is_array($materias))
    {
        foreach($materias as $materia)
        {
            $arrMateria = array();
            $arrMateria["asignatura"] = $materia['materia'];
            $sumatoria_materia = 0;
            for($periodo = 1; $periodo <= 5; $periodo++)
            {
                $tmp_calificacion = Calificacion::getCalificacion($alumno->id_persona, $periodo, $materia['id_clase']);
                $arrMateria["bimestre".$periodo] = $tmp_calificacion;
                $sumatoria_materia += $tmp_calificacion;
            }
            if($sumatoria_materia > 0)
            {
                $promedio_materia = $sumatoria_materia / 5;
                $promedio_final += $promedio_materia;
                $arrMateria["promedio"] = $promedio_materia;
                $calificadas++;
            }
            else $arrMateria["promedio"] = "N/A";
            array_push($JSONmaterias, $arrMateria);
        }
        $promedio_final = $promedio_final / $calificadas;

        $arr = array(
            'validar' => "1", 
            'tipo_persona' => $alumno->tipo_persona, 
            "alumno" => array(
                "nombre" => $alumno->nombres, 
                "apellido_paterno" => $alumno->apellido_paterno,
                "apellido_materno" => $alumno->apellido_materno,
                "matricula" => $alumno->matricula,
                "grado" => $alumno->grado,
                "grupo" => $alumno->grupo
            ),
            'materias' => $JSONmaterias,
            "promedio_final" => number_format($promedio_final, 1, '.', '')
        );
        echo json_encode($arr);
    }
    else
    {
        $arr = array(
            'validar' => "2", 
            "alumno" => array(
                "nombre" => $alumno->nombres, 
                "apellido_paterno" => $alumno->apellido_paterno,
                "apellido_materno" => $alumno->apellido_materno,
                "matricula" => $alumno->matricula,
                "grado" => $alumno->grado,
                "grupo" => $alumno->grupo
            )
        );
        echo json_encode($arr);
    }
}
else
{
    $arr = array(
        'validar' => "0"
    );
    echo json_encode($arr);
}