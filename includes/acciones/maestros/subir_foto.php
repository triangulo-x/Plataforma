<?php
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_POST);
# fotoVal
# id_maestroVal

$maestro = new Maestro($id_maestroVal);

$directorio = "../../../media/fotos/";

if(isset($_FILES["fotoVal"]))
{
    if ($_FILES["fotoVal"]["error"] > 0)
    {
        echo "error";
    }
    else
    {
        move_uploaded_file($_FILES["fotoVal"]["tmp_name"], $directorio.$_FILES["fotoVal"]["name"]);
        $maestro->asignarFoto($_FILES["fotoVal"]["name"]);
        echo $_FILES["fotoVal"]["name"];
    }
}

?>