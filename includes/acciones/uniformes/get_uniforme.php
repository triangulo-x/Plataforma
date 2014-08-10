<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 26/02/14
 * Time: 05:50 PM
 * Obtiene el código de un uniforme y regresa dicho uniforme
 * en formato JSON
 */

include_once("../../clases/class_lib.php");
include_once("../../validar_admin.php");
extract($_POST);
# codigo
# id_uniforme

if(!is_null($id_uniforme))
{
    $uniforme = Uniforme::getUniforme($id_uniforme);
    if(!is_null($uniforme))
    {
        echo json_encode($uniforme);
    }
    else echo "código inválido";
}
else echo "error";