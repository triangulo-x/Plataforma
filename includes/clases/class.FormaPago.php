<?php
/**
 * Created by PhpStorm.
 * User: Yozki
 * Date: 11/12/13
 * Time: 01:07 PM
 */

include_once("class.Database.php");

class FormaPago
{
    # Métodos estáticos
    public static function getFormasPago()
    {
        return Database::select("SELECT * FROM cuentas_forma_pago");
    }
} 