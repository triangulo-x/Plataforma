<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

include_once("../../validar_maestro.php");
include_once("../../clases/class_lib.php");
extract($_POST);
# id_grado
# id_materia
# planeacion :Arreglo[Arreglo[{Tema}]]

/** Paso 1. Insertar la planeacion en planeacion_plan */
$id_planeacion = Plan::insert($id_grado, $id_materia);
$plan = new Plan($id_planeacion);

$planeacion = str_replace('\"','"', $planeacion);
$planeacion = json_decode($planeacion);

$bloque_no = 0;
foreach($planeacion as $bloque)
{
    $bloque_no++;
    foreach($bloque as $tema)
    {
        /** Paso 2. Insertar el tema a planeacion_tema */
        $id_tema = $plan->asignarTema($tema->id_tema, $bloque_no);
        $tema_planeado = new PlaneacionTema($id_tema);
        print_r($tema_planeado);

        /** Paso 3. Asignar las estrategias al tema planeado */
        $estrategias = $tema->estrategias;
        print_r($estrategias);
        foreach($estrategias as $estrategia)
        {
            $tema_planeado->asignarEstrategia($estrategia);
        }

        /** Paso 4. Asignar los métodos de evaluación al tema planeado */
        $metodos = $tema->metodos;
        foreach($metodos as $metodo)
        {
            $tema_planeado->asignarMetodo($metodo);
        }
    }
}