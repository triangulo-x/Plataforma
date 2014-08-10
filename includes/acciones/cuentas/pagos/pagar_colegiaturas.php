<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 2/04/14
 * Time: 3:47 PM
 */

$id_modulo = 17; // Cuentas - Pagos
include_once("../../../validar_admin.php");
include_once("../../../clases/class_lib.php");
include_once("../../../validar_acceso.php");
extract($_POST);
# id_cuenta
# id_ciclo_escolar
# id_forma_pago
# abonos (Arreglo de objetos{id_cuenta, abono})

$abonos = json_decode(stripslashes($abonos));

if(is_array($abonos))
{
    /** Si se van a realizar pagos. Se crea un nuevo # de recibo */
    $recibo = Cuenta::generarNuevoRecibo();

    foreach($abonos as $abono)
    {
        $cuenta = new Cuenta($abono->id_cuenta);
        $id_pago = $cuenta->agregarPago($abono->abono, $id_forma_pago, $recibo, $comentario);
    }
}

echo $recibo;