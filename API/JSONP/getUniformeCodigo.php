<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 5/03/14
 * Time: 05:39 PM
 */

include_once("../../includes/clases/class_lib.php");
extract($_GET);
# matricula
# password
# codigo

header('content-type: application/json; charset=utf-8');

$persona = Persona::login($matricula, $password);

if($persona->id_persona != 0)
{
    $uniforme = Uniforme::getUniformeCodigo($codigo);

    array_walk_recursive($uniforme, function(&$value, $key) {
        if (is_string($value)) {
            $value = iconv('windows-1252', 'utf-8', $value);
        }
    });

    $arr = array(
        'valido' => "1",
        "uniforme" => $uniforme
    );
}
else
{
    $arr = array('valido' => "0");
}

echo $_GET['callback'] . '('.json_encode($arr).')';