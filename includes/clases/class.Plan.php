<?php
/**
 * Created by PhpStorm.
 * User: Yozki
 * Date: 23/10/13
 * Time: 01:54 PM
 */

class Plan
{
    public $id_plan;
    public $id_grado;
    public $id_materia;
    public $id_ciclo_escolar;

    function __construct($id_plan)
    {
        $plan = Database::select("SELECT * FROM planeacion_plan WHERE id_plan = $id_plan");
        $plan = $plan[0];
        $this->id_plan = $plan['id_plan'];
        $this->id_grado = $plan['id_grado'];
        $this->id_materia = $plan['id_materia'];
        $this->id_ciclo_escolar = $plan['id_ciclo_escolar'];
    }

    function asignarTema($id_tema, $bloque)
    {
        $query = "INSERT INTO planeacion_tema_p VALUES(null, $id_tema, $bloque, $this->id_plan)";
        return Database::insert($query);
    }

    function getTemasBloque($id_bloque)
    {
        $query = "SELECT id_tema_planeado FROM planeacion_tema_p
            JOIN planeacion_temas ON planeacion_temas.id_tema = planeacion_tema_p.id_tema
            WHERE id_plan = $this->id_plan AND bloque = $id_bloque";
        $temas = Database::select($query);
        if(is_array($temas))
        {
            $temas_array = array();
            foreach($temas as $tema)
            {
                array_push($temas_array, new PlaneacionTema($tema['id_tema_planeado']));
            }
            return $temas_array;
        }
    }

    function getNombreGrado()
    {
        $query = "SELECT CONCAT(grado, ' de ', area) AS grado FROM planeacion_plan
            JOIN grado ON planeacion_plan.id_grado = grado.id_grado
            JOIN area ON area.id_area = grado.id_area
            WHERE id_plan = $this->id_plan";
        $rs = Database::select($query);
        return $rs[0]['grado'];
    }

    function getNombreMateria()
    {
        $query = "SELECT materia FROM planeacion_plan
            JOIN materia ON materia.id_materia = planeacion_plan.id_materia
            WHERE id_plan = $this->id_plan";
        $rs = Database::select($query);
        return $rs[0]['materia'];
    }

    function getNombrePlaneador()
    {
        $query = "SELECT CONCAT(persona.nombres, ' ', persona.apellido_paterno, ' ', persona.apellido_materno) AS persona
            FROM planeacion_plan
            JOIN persona ON persona.id_persona = planeacion_plan.id_persona
            WHERE id_plan = $this->id_plan";
        $rs = Database::select($query);
        return $rs[0]['persona'];
    }

    # Métodos estáticos

    static function insert($id_grado, $id_materia)
    {
        $id_persona = $_SESSION['id_persona'];
        $ciclo_escolar = CicloEscolar::getActual();
        $query = "INSERT INTO planeacion_plan VALUES(null, $id_grado, $id_materia, $ciclo_escolar->id_ciclo_escolar, $id_persona)";
        return Database::insert($query);
    }

    static function getPlaneaciones()
    {
        $query = "SELECT id_plan, grado, materia,
            CONCAT(persona.nombres, ' ', persona.apellido_paterno, ' ', persona.apellido_materno) AS persona
            FROM planeacion_plan
            JOIN grado ON grado.id_grado = planeacion_plan.id_grado
            JOIN materia ON materia.id_materia = planeacion_plan.id_materia
            JOIN persona ON persona.id_persona = planeacion_plan.id_persona";
        return Database::select($query);
    }
} 