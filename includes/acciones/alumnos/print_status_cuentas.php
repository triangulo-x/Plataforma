<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 30/05/14
 * Time: 03:27 PM
 */

include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_POST);
// id_alumno
// id_ciclo_escolar

function getNombreMes($mes)
{
    switch ($mes)
    {
        case 1: return 'Agosto';        break;
        case 2: return 'Septiembre';    break;
        case 3: return 'Octubre';       break;
        case 4: return 'Noviembre';     break;
        case 5: return 'Diciembre';     break;
        case 6: return 'Julio';         break;
        case 7: return 'Enero';         break;
        case 8: return 'Febrero';       break;
        case 9: return 'Marzo';         break;
        case 10: return 'Abril';        break;
        case 11: return 'Mayo';         break;
        case 12: return 'Junio';        break;
    }
}

$alumno = new Alumno($id_alumno);

$inscripcion = $alumno->getInscripcionStatus($id_ciclo_escolar);
$colegiaturas = $alumno->getColegiaturasStatus($id_ciclo_escolar);

if($inscripcion["adeudo"] == 0) $color = "style='color: rgb(0, 128, 0);'";
else if($inscripcion["adeudo"] > 0 && $inscripcion["recargos"] > 0) $color = "style='color: rgb(128, 0, 0);'";

# subtotal | descuento | total | pagado | adeudo

echo "
    <tr class='cuenta' >
        <td class='td_cuenta' $color>Inscripción
            <input type='hidden' class='id_cuentaVal' value='".$inscripcion['id_cuenta']."' />
        </td>
        <td>$".$inscripcion['subtotal']."</td>
        <td>$0</td>
        <td>$".$inscripcion['descuento']."</td>
        <td>$".$inscripcion['total']."</td>
        <td>$".$inscripcion['pagado']."</td>
        <td class='td_adeudo' >
            <input type='hidden' class='adeudoVal' value='".$inscripcion['adeudo']."' />
            $".$inscripcion['adeudo']."
        </td>
        <td>".$inscripcion['fecha']."</td>
        <td class='td_monto'><input type='number' class='montoVal' /></td>
    </tr>
";

print_r($colegiaturas);

foreach($colegiaturas as $colegiatura)
{
    $color = "";
    echo "adeudo: ".$colegiatura['adeudo'];
    if($colegiatura["adeudo"] == 0) $color = "style='color: rgb(0, 128, 0);'";
    else if($colegiatura["adeudo"] > 0 && $colegiatura["recargos"] > 0) $color = "style='color: rgb(128, 0, 0);'";

    echo "
        <tr class='cuenta' >
            <td class='td_cuenta' $color>
                ".getNombreMes($colegiatura['mes'])."
                <input type='hidden' class='id_cuentaVal' value='".$colegiatura['id_cuenta']."' />
            </td>
            <td>$".$colegiatura['subtotal']."</td>
            <td>$".$colegiatura['recargos']."</td>
            <td>$".$colegiatura['descuento']."</td>
            <td>$".$colegiatura['total']."</td>
            <td>$".$colegiatura['pagado']."</td>
            <td class='td_adeudo'>
                <input type='hidden' class='adeudoVal' value='".$colegiatura['adeudo']."' />
                $".$colegiatura['adeudo']."
            </td>
            <td>".$colegiatura['fecha_limite']."</td>
            <td class='td_monto'><input type='number' class='montoVal' /></td>
        </tr>
    ";
}