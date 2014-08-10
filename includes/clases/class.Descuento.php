<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 9/01/14
 * Time: 10:28 AM
 */

class Descuento
{
    public $id_descuento;
    public $id_persona;
    public $id_concepto;
    public $fecha_autorizacion;
    public $fecha_utilizacion;
    public $id_usuario;
    public $monto;

    function __construct($id_descuento)
    {
        $descuento = Database::select("SELECT * FROM cuentas_descuento WHERE id_descuento = $id_descuento");
        $descuento = $descuento[0];
        $this->id_descuento         = $descuento['id_descuento'];
        $this->id_persona           = $descuento['id_persona'];
        $this->id_concepto          = $descuento['id_concepto'];
        $this->fecha_autorizacion   = $descuento['fecha_autorizacion'];
        $this->fecha_utilizacion    = $descuento['fecha_utilizacion'];
        $this->id_usuario           = $descuento['id_usuario'];
        $this->monto                = $descuento['monto'];
    }

    function eliminar()
    {
        if(is_null($this->fecha_utilizacion))
        {
            $query = "DELETE FROM cuentas_descuento WHERE id_descuento = $this->id_descuento";
            return Database::update($query);
        }
        else return false;
    }

    # Métodos estáticos

    static function insert($id_cuenta, $monto)
    {

        session_start();
        $id_usuario = $_SESSION['id_persona'];
        $query = "INSERT INTO cuentas_descuento VALUES(null, $id_cuenta, $monto, NOW(), $id_usuario);";
        return Database::insert($query);
    }

    /** Lista de todos los descuentos autorizados, independientemente de si han sido utilizados o no */
    static function getDescuentos()
    {
        $query = "SELECT
            id_descuento, alumno.id_persona AS id_alumno,
            CONCAT(alumno.nombres, ' ', alumno.apellido_paterno, ' ', alumno.apellido_materno) AS alumno,
            cuentas_concepto.id_concepto, cuentas_concepto.concepto,
            CAST(fecha_autorizacion AS DATE) AS fecha_autorizacion, CAST(fecha_utilizacion AS DATE) AS fecha_utilizacion,
            id_usuario, CONCAT(usuario.nombres, ' ', usuario.apellido_paterno, ' ', usuario.apellido_materno) AS usuario,
            monto
            FROM cuentas_descuento
            LEFT JOIN persona AS alumno ON alumno.id_persona = cuentas_descuento.id_persona
            LEFT JOIN cuentas_concepto ON cuentas_concepto.id_concepto = cuentas_descuento.id_concepto
            LEFT JOIN persona AS usuario ON usuario.id_persona = cuentas_descuento.id_usuario";
        return Database::select($query);
    }

    /** Solo regresa los descuentos que no se han utilizado (Culla fecha_utilización es NULL) */
    static function getDescuentosPendientes()
    {
        $query = "SELECT
            id_descuento, alumno.id_persona AS id_alumno,
            CONCAT(alumno.nombres, ' ', alumno.apellido_paterno, ' ', alumno.apellido_materno) AS alumno,
            cuentas_concepto.id_concepto, cuentas_concepto.concepto,
            CAST(fecha_autorizacion AS DATE) AS fecha_autorizacion, CAST(fecha_utilizacion AS DATE) AS fecha_utilizacion,
            id_usuario, CONCAT(usuario.nombres, ' ', usuario.apellido_paterno, ' ', usuario.apellido_materno) AS usuario,
            monto
            FROM cuentas_descuento
            LEFT JOIN persona AS alumno ON alumno.id_persona = cuentas_descuento.id_persona
            LEFT JOIN cuentas_concepto ON cuentas_concepto.id_concepto = cuentas_descuento.id_concepto
            LEFT JOIN persona AS usuario ON usuario.id_persona = cuentas_descuento.id_usuario
            WHERE fecha_utilizacion IS NULL";
        return Database::select($query);
    }
} 