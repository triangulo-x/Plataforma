<?php
/**
 * Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

include_once("../../../validar_maestro.php");
include_once("../../../clases/class_lib.php");
extract($_POST);
# tema
# id_grado
# id_materia

if(is_null($tema)) exit();

$id_tema = Tema::insert($tema, $id_grado, $id_materia);
echo '<li id="'.$id_tema.'" class="swappable" onclick="temaSeleccionado(this);">'.$tema.'</li>';