<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 5/03/14
 * Time: 04:49 PM
 */

include_once("../../includes/clases/class_lib.php");
extract($_GET);
# matricula
# password

header('content-type: application/json; charset=utf-8');

$persona = Persona::login($matricula, $password);

if($persona->id_persona != 0)
{
    $uniformes = Uniforme::getUniformes();

    array_walk_recursive($uniformes, function(&$value, $key) {
        if (is_string($value)) {
            $value = iconv('windows-1252', 'utf-8', $value);
        }
    });

    $arr = array(
        'valido' => "1",
        'uniformes' => $uniformes
    );
}
else
{
    $arr = array(
        'valido' => "0"
    );
}

echo $_GET['callback'] . '('.json_encode($arr).')';