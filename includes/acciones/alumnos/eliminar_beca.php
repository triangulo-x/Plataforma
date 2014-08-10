<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

$id_modulo = 10; // Becas - Nueva
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
include_once("../../validar_acceso.php");
extract($_GET);
# id_alumno

$alumno = new Alumno($id_alumno);

$id_ciclo_actual = CicloEscolar::getActual()->id_ciclo_escolar;
if($alumno->quitarBecasCiclo($id_ciclo_actual))
{
    header('Location: /admin/becas/lista.php');
}
else
{
    header('Location: /admin/becas/lista.php?error=2');
}