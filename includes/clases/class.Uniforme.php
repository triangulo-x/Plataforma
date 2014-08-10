<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 26/02/14
 * Time: 06:01 PM
 */

class Uniforme
{
    public $id_uniforme;
    public $descripcion;
    public $codigo;
    public $costo;
    public $precio;

    function __construct($id_uniforme)
    {
        $uniforme = Database::select("SELECT * FROM uniforme WHERE id_uniforme = $id_uniforme");
        $uniforme = $uniforme[0];
        $this->id_uniforme     = $uniforme['id_uniforme'];
        $this->descripcion     = $uniforme['descripcion'];
        $this->codigo          = $uniforme['codigo'];
        $this->costo           = $uniforme['costo'];
        $this->precio          = $uniforme['precio'];
    }

    function setDescripcion($descripcion)
    {
        $query = "UPDATE uniforme SET descripcion = '$descripcion' WHERE id_uniforme = $this->id_uniforme";
        return Database::update($query);
    }

    function setCodigo($codigo)
    {
        $query = "UPDATE uniforme SET codigo = '$codigo' WHERE id_uniforme = $this->id_uniforme";
        return Database::update($query);
    }

    function setCosto($costo)
    {
        $query = "UPDATE uniforme SET costo = $costo WHERE id_uniforme = $this->id_uniforme";
        return Database::update($query);
    }

    function setPrecio($precio)
    {
        $query = "UPDATE uniforme SET precio = $precio WHERE id_uniforme = $this->id_uniforme";
        return Database::update($query);
    }

    # Métodos estáticos
    static function insert($descripcion, $codigo, $precio)
    {
        $query = "INSERT INTO uniforme VALUES(null, '$descripcion', '$codigo', 0, $precio)";
        return Database::insert($query);
    }

    static function getUniforme($id_uniforme)
    {
        $query = "SELECT id_uniforme, descripcion, codigo, costo, precio,
            IFNULL(comprados, 0) AS comprados, IFNULL(vendidos, 0) AS vendidos,
            (IFNULL(comprados, 0) - IFNULL(vendidos, 0)) AS inventario FROM (
            SELECT uniforme.*, comprados, vendidos FROM uniforme
            LEFT JOIN (SELECT id_uniforme, SUM(cantidad) AS comprados FROM uniforme_compra GROUP BY id_uniforme) AS comprados
            ON uniforme.id_uniforme = comprados.id_uniforme
            LEFT JOIN (SELECT id_uniforme, SUM(cantidad) AS vendidos FROM uniforme_venta GROUP BY id_uniforme) AS vendidos
            ON uniforme.id_uniforme = vendidos.id_uniforme
            WHERE uniforme.id_uniforme = $id_uniforme) AS TB";
        $uniformes = Database::select($query);
        return $uniformes[0];
    }

    static function getUniformeCodigo($codigo)
    {
        $query = "SELECT id_uniforme, descripcion, codigo, costo, precio,
            IFNULL(comprados, 0) AS comprados, IFNULL(vendidos, 0) AS vendidos,
            (IFNULL(comprados, 0) - IFNULL(vendidos, 0)) AS inventario FROM (
            SELECT uniforme.*, comprados, vendidos FROM uniforme
            LEFT JOIN (SELECT id_uniforme, SUM(cantidad) AS comprados FROM uniforme_compra GROUP BY id_uniforme) AS comprados
            ON uniforme.id_uniforme = comprados.id_uniforme
            LEFT JOIN (SELECT id_uniforme, SUM(cantidad) AS vendidos FROM uniforme_venta GROUP BY id_uniforme) AS vendidos
            ON uniforme.id_uniforme = vendidos.id_uniforme
            WHERE uniforme.codigo = '$codigo') AS TB";
        $uniformes = Database::select($query);
        return $uniformes[0];
    }

    static function nuevaVenta($id_uniforme, $id_persona, $cantidad, $precio, $id_area)
    {
        $query = "INSERT INTO uniforme_venta VALUES(null, NOW(), $id_uniforme, $id_persona, $cantidad, $precio, $id_area)";
        return Database::insert($query);
    }

    static function nuevaCompra($id_uniforme, $cantidad, $costo)
    {
        $query = "INSERT INTO uniforme_compra VALUES(null, NOW(), $id_uniforme, $cantidad, $costo)";
        return Database::insert($query);
    }

    static function getUniformes()
    {
        $query = "SELECT * FROM uniforme";
        return Database::select($query);
    }
} 