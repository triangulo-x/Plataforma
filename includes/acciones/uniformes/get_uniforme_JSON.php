<?php
/**
 * Created by PhpStorm.
 * User: Yozki
 * Date: 2/27/14
 * Time: 4:50 PM
 */

include_once("../../clases/class_lib.php");
include_once("../../validar_admin.php");
extract($_POST);
# id_uniforme



if(!is_null($id_uniforme))
{
    $uniforme = Uniforme::getUniforme($id_uniforme);

    array_walk(
        $uniforme,
        function (&$entry) {
            $entry = iconv('latin1', 'UTF-8', $entry);
        }
    );


    if(!is_null($uniforme))
    {
        echo json_encode($uniforme);
    }
    else echo "código inválido";
}
else echo "error";