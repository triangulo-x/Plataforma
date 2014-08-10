<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 6/03/14
 * Time: 03:20 PM
 */

include_once("../../includes/clases/class_lib.php");
extract($_GET);
# matricula
# password
# id_uniforme
# id_persona
# cantidad
# precio
# id_area

header('content-type: application/json; charset=utf-8');

$persona = Persona::login($matricula, $password);

if($persona->id_persona != 0)
{
    if(is_null($id_uniforme)){ $arr = array('valido' => "0"); exit(); }
    if(is_null($id_persona)){ $arr = array('valido' => "0"); exit(); }
    if(is_null($cantidad)){ $arr = array('valido' => "0"); exit(); }
    if(is_null($id_area)){ $arr = array('valido' => "0"); exit(); }
    if(is_null($precio)){ $arr = array('valido' => "0"); exit(); }

    if(Uniforme::nuevaVenta($id_uniforme, $id_persona, $cantidad, $precio, $id_area))
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