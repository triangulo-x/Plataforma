<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 6/03/14
 * Time: 06:20 PM
 */

include_once("../../includes/clases/class_lib.php");
extract($_GET);
# matricula
# password
# id_uniforme
# cantidad
# costo

header('content-type: application/json; charset=utf-8');

$persona = Persona::login($matricula, $password);

if($persona->id_persona != 0)
{
    if(is_null($id_uniforme)){ $arr = array('valido' => "0"); exit(); }
    if(is_null($cantidad)){ $arr = array('valido' => "0"); exit(); }
    if(is_null($costo)){ $arr = array('valido' => "0"); exit(); }

    if(Uniforme::nuevaCompra($id_uniforme, $cantidad, $costo))
    {
        $arr = array(
            'valido' => "1",
            "success" => "1"
        );
    }
    else
    {
        $arr = array(
            'valido' => "1",
            "success" => "0"
        );
    }
}
else
{
    $arr = array('valido' => "0");
}

echo $_GET['callback'] . '('.json_encode($arr).')';