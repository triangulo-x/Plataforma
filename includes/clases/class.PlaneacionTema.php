<?php
/**
 * Created by PhpStorm.
 * User: Yozki
 * Date: 22/10/13
 * Time: 01:43 PM
 */

include_once("class.Database.php");
class PlaneacionTema
{
    public $id_tema_planeado;
    public $id_tema;
    public $bloque;
    public $id_plan;

    function __construct($id_tema_planeado)
    {
        $tema_planeado = Database::select("SELECT * FROM planeacion_tema_p WHERE id_tema_planeado = $id_tema_planeado");
        $tema_planeado = $tema_planeado[0];
        $this->id_tema_planeado     = $tema_planeado['id_tema_planeado'];
        $this->id_tema              = $tema_planeado['id_tema'];
        $this->bloque               = $tema_planeado['bloque'];
        $this->id_plan              = $tema_planeado['id_plan'];
    }

    /** Inserta una nueva estrategia a la planeación, NO a la lista de estrategias de x tema */
    function asignarEstrategia($id_estrategia)
    {
        $query = "INSERT INTO planeacion_estrategia VALUES($this->id_tema_planeado, $id_estrategia)";
        return Database::insert($query);
    }

    function asignarMetodo($id_metodo)
    {
        $query = "INSERT INTO planeacion_metodo VALUES($this->id_tema_planeado, $id_metodo)";
        return Database::insert($query);
    }

    function getEstrategias()
    {
        $query = "SELECT estrategia FROM planeacion_estrategia
            JOIN planeacion_estrategias ON planeacion_estrategias.id_estrategia = planeacion_estrategia.id_estrategia
            WHERE id_tema_planeado = $this->id_tema_planeado";
        return Database::select($query);
    }

    function getMetodos()
    {
        $query = "SELECT metodo FROM planeacion_metodo
            JOIN planeacion_metodos_ev ON planeacion_metodos_ev.id_metodo = planeacion_metodo.id_metodo
            WHERE id_tema_planeado = $this->id_tema_planeado";
        return Database::select($query);
    }

    function getNombreTema()
    {
        $query = "SELECT tema FROM planeacion_tema_p
            JOIN planeacion_temas ON planeacion_temas.id_tema = planeacion_tema_p.id_tema
            WHERE id_tema_planeado = $this->id_tema_planeado";
        $res = Database::select($query);
        return $res[0]['tema'];
    }

    # Métodos estáticos

    /** Inserta un nuevo tema a la planeación, NO a la lista de temas disponibles. */
    static function planearTema($id_tema, $bloque, $id_plan)
    {
        $query = "INSERT INTO planeacion_tema VALUES(null, $id_tema, $bloque, $id_plan)";
        return Database::insert($query);
    }
} 