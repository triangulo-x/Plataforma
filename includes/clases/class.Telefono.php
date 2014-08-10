<?php
include_once("class.Database.php");

class Telefono
{
    public $id_telefono;
    public $id_persona;
    public $telefono;
    public $tipo_telefono;

    function __construct($id_telefono)
    {
        $telefono = Database::select("SELECT * FROM telefono WHERE id_telefono = $id_telefono LIMIT 1;");
        $telefono = $telefono[0];
        $this->id_telefono          = $telefono['id_telefono'];
        $this->id_persona           = $telefono['id_persona'];
        $this->telefono             = $telefono['telefono'];
        $this->tipo_telefono        = $telefono['tipo_telefono'];
    }

    function eliminar()
    {
        $query = "DELETE FROM telefono WHERE id_telefono = $this->id_telefono";
        return Database::update($query);
    }

    # Método estáticos
    public static function getTipos()
    {
        return Database::select("SELECT * FROM tipo_telefono");
    }
}

?>