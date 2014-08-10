<?php
/**
 * User: Gustavo
 * Date: 21/03/14
 * Time: 01:37 PM
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

if(!is_null($id_alumno))
{
    $alumno = new Alumno($id_alumno);

    /** Calcular recargos y actualizar cuentas... */
    $alumno->actualizarRecargos($id_ciclo_escolar);

    /** Imprimir la tabla de colegiaturas */
    if(!is_null($alumno->id_persona))
    {
        $colegiaturas = $alumno->getColegiaturasStatus($id_ciclo_escolar);
        if(is_array($colegiaturas))
        {
            foreach($colegiaturas as $colegiatura)
            {
                /** Verde si adeudo = 0 | Rojo si fecha_limite < fecha actual */

                if(strtotime($colegiatura['fecha_limite']) < strtotime(date("Y-m-d"))) $color = 'red';
                else $color = '';

                if($colegiatura['adeudo'] <= 0) $color = 'green';

                echo "
                    <tr style='color: ".$color."' class='colegiatura' >
                        <td class='td_cuenta'>
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
        }
    }
}