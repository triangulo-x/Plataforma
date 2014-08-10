<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 6/03/14
 * Time: 06:01 PM
 */

include_once("../../includes/clases/class_lib.php");
extract($_GET);
# matricula
# password
# descripcion
# codigo
# precio

header('content-type: application/json; charset=utf-8');

$persona = Persona::login($matricula, $password);

if($persona->id_persona != 0)
{
    if(is_null($matricula)){ $arr = array('valido' => "0"); exit(); }
    if(is_null($password)){ $arr = array('valido' => "0"); exit(); }
    if(is_null($descripcion)){ $arr = array('valido' => "0"); exit(); }
    if(is_null($codigo)){ $arr = array('valido' => "0"); exit(); }
    if(is_null($precio)){ $arr = array('valido' => "0"); exit(); }

    if(Uniforme::insert($descripcion, $codigo, $precio))
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