<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 5/06/14
 * Time: 12:06 PM
 */

$id_modulo = 39; // Cuentas - Descuento
include_once("../../../../includes/validar_admin.php");
include_once("../../../../includes/clases/class_lib.php");
include_once("../../../../includes/validar_acceso.php");
extract($_POST);
# id_persona
# id_ciclo_escolar
# descuentos (JSON)

$descuentos = json_decode(stripslashes($descuentos));

$alumno = new Alumno($id_persona);

foreach($descuentos as $descuento)
{
    /** Además de insertar el descuento se hará una modificación a la cuenta para reflejar el nuevo total de
     * descuento esto para contar con el monto total y no estár calculando el descuento cada vez que se quiera
     * mostrar el status de una cuenta */
    Descuento::insert($descuento->id_cuenta, $descuento->descuento);

    $cuenta = new Cuenta($descuento->id_cuenta);
    $cuenta->recalcularDescuento();
}
echo 1;