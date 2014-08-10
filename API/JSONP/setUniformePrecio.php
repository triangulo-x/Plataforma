<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 6/03/14
 * Time: 02:34 PM
 */

include_once("../../includes/clases/class_lib.php");
extract($_GET);
# matricula
# password
# id_uniforme
# precio

header('content-type: application/json; charset=utf-8');

$persona = Persona::login($matricula, $password);

if($persona->id_persona != 0)
{
    $uniforme = new Uniforme($id_uniforme);
    if($uniforme->setPrecio($precio)) $success = 1; else $success = 0;
    $arr = array(
        'valido' => "1",
        "success" => $success
    );
}
else
{
    $arr = array('valido' => "0");
}

echo $_GET['callback'] . '('.json_encode($arr).')';