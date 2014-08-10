<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

include("../../validar_admin.php");
include("../../clases/class_lib.php");
extract($_POST);
# id_persona
# tipo_tutor
# nombre
# calle
# numero
# colonia
# CP
# telefonos
# celular

if(is_null($id_persona) || is_null($tipo_tutor) || is_null($nombre) || is_null($telefonos))
{
    echo 2; // Error: Datos vacios
    exit();
}
else
{
    $alumno = new Alumno($id_persona);
    if($alumno->asignarTutor($tipo_tutor, $nombre, $calle, $numero, $colonia, $CP, $telefonos, $celular))
    {
        echo 1; // Success
        exit();
    }
    else
    {
        echo 3; // Error al insertar tutor a la BD
        exit();
    }
}