<?php
include_once("class.Database.php");

class Concepto
{
    public $id_concepto;
    public $concepto;
    public $monto_sugerido;

    function __construct($id_concepto)
    {
        $concepto = Database::select("SELECT * FROM cuentas_concepto WHERE id_concepto = $id_concepto");
        $concepto = $concepto[0];
        $this->id_concepto      = $concepto['id_concepto'];
        $this->concepto         = $concepto['concepto'];
        $this->monto_sugerido   = $concepto['monto_sugerido'];
    }

    function update()
    {
        $query = "UPDATE cuentas_concepto SET concepto = '$this->concepto', monto_sugerido = $this->monto_sugerido
                WHERE id_concepto = $this->id_concepto";
        return Database::update($query);
    }

    # Métodos estáticos
    static function getLista()
    {
        return Database::select("SELECT * FROM cuentas_concepto");
    }

    static function insert($concepto, $monto_sugeridoVal)
    {
        return Database::insert("INSERT INTO cuentas_concepto SET concepto = '$concepto', monto_sugerido = $monto_sugeridoVal");
    }
}