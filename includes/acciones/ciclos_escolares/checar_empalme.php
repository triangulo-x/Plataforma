<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 22/01/14
 * Time: 03:43 PM
 * Recibe: fechas de inicio y fin de un nuevo ciclo escolar
 * Acción: Checa si existe un empalme entre el potencial ciclo escolar y otros ciclos escolares
 * Regresa: 1 si hay empalme | 0 si no hay empalme
 */

include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_POST);
# fecha_inicio  : 'yy-mm-dd'
# fecha_fin     : 'yy-mm-dd'

$query = "SELECT IF(COUNT(*) > 0, 1, 0) AS empalma FROM ciclo_escolar WHERE fecha_inicio < '$fecha_inicio' AND fecha_fin > '$fecha_inicio'";

$res = Database::select($query);
echo $res[0]['empalma'];