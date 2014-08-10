<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 28/02/14
 * Time: 04:04 PM
 */

include_once("../../includes/clases/class_lib.php");
extract($_GET);
# matricula
# password

header('content-type: application/json; charset=utf-8');

$persona = Persona::login($matricula, $password);

if($persona->id_persona != 0)
{
    $arr = array(
        'valido' => "1",
        'tipo_persona' => $persona->tipo_persona,
        "datos" => array(
            "nombre" => $persona->nombres,
            "apellido_paterno" => $persona->apellido_paterno,
            "apellido_materno" => $persona->apellido_materno,
            "matricula" => $persona->matricula
        ),
        'permisos' => $persona->getPermisos()
    );
}
else
{
    $arr = array(
        'valido' => "0"
    );
}

echo $_GET['callback'] . '('.json_encode($arr).')';