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
# id_alumno

header('content-type: application/json; charset=utf-8');

$persona = Persona::login($matricula, $password);

if($persona->id_persona != 0)
{
    $alumno = new Alumno($id_alumno);
    $arr = array(
        'valido' => "1",
        'alumno' => $alumno
    );
}
else
{
    $arr = array(
        'valido' => "0"
    );
}

echo $_GET['callback'] . '('.json_encode($arr).')';