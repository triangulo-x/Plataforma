<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 17/06/14
 * Time: 01:28 PM
 */

include_once("../../includes/validar_admin.php");
include_once("../../includes/clases/class_lib.php");
extract($_GET);
# id_alumno
# ciclo

$alumno = new Alumno($id_alumno);
if(is_null($alumno->id_persona)){ header('Location: /admin/alumnos/index.php'); exit; }

$inscripcion = $alumno->getInscripcionStatus($ciclo);
$inscripcion = new Cuenta($inscripcion['id_cuenta']);
$adeudo_inscripcion = $inscripcion->monto - $inscripcion->descuento - $inscripcion->pagado;
$colegiaturas = $alumno->getColegiaturasStatus($ciclo);

$beca = $alumno->getBeca($ciclo);
$beca = $beca['beca'];
if(is_null($beca)) $beca = '-';

$area = $alumno->getArea();
$area = $area['area'];

$CURP = $alumno->getCURP();
if(is_null($CURP) || $CURP == "") $CURP = "-";

setlocale(LC_ALL, 'es_MX');

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
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../../estilo/perfil_cuentas.css" />
    </head>
    <body>

    <div id="recibo_header" >
        <img src="/media/logos/meze_chico.jpg" style="float: left; height: 130px; margin: 10px;" />
        <div id="recibo_texto_header">
            <h2>COLEGIO MEZE, A.C.</h2>
            <h4>INCORPORADO A LA S.E.P.C.</h4>
            <h5>Av. Adolfo López Mateos # 1030 Col. Zaragoza C.P. 27297</h5>
            <h5>Tel. 792-93-93 Torreón, Coah. R.F.C. CME-050302-8T9</h5>
            <h4>LUGAR DE EXPEDICIÓN: TORREÓN, COAH.</h4>
            <h4>REGIMEN DE LAS PERSONAS MORALES CON FINES NO LUCRATRIVOS</h4>
        </div>
    </div>

    <div id="tabla_cuentas_wrapper">
        <h1>Resumen de cuentas al <?php echo strftime("%d de %B de %Y"); ?></h1>

        <div id="datos_alumno">
            <div id="datos_alumno_left">
                <div class="dato_alumno">
                    <label>Nombre</label>
                    <div class="value"><?php echo $alumno->getNombreCompleto(); ?></div>
                </div>
                <div class="dato_alumno">
                    <label>Matrícula</label>
                    <div class="value"><?php echo $alumno->matricula; ?></div>
                </div>
                <div class="dato_alumno">
                    <label>CURP</label>
                    <div class="value"><?php echo $CURP; ?></div>
                </div>
                <div class="dato_alumno">
                    <label>Beca</label>
                    <div class="value"><?php echo $beca; ?>%</div>
                </div>
            </div>
            <div id="datos_alumno_right">
                <div class="dato_alumno">
                    <label>Nivel</label>
                    <div class="value"><?php echo $area; ?></div>
                </div>
                <div class="dato_alumno">
                    <label>Grado</label>
                    <div class="value"><?php echo $alumno->getGrado($ciclo); ?></div>
                </div>
                <div class="dato_alumno">
                    <label>Grupo</label>
                    <div class="value"><?php echo $alumno->getGrupo($ciclo); ?></div>
                </div>
            </div>
        </div>

        <hr />

        <?php
            if(is_null($inscripcion->id_cuenta))
            {
                echo "<h3>El alumno no estuvo inscrito en el ciclo seleccionado</h3>";
                exit();
            }
        ?>

        <table id="tabla_cuentas">
            <thead>
                <tr>
                    <th style="width: 10%" >Recibo</th>
                    <th style="width: 15%" >Fecha de pago</th>
                    <th style="width: 10%" >Concepto</th>
                    <th style="width: 10%" >Subtotal</th>
                    <th style="width: 10%" >Recargos</th>
                    <th style="width: 10%" >Descuento</th>
                    <th style="width: 10%" >Total</th>
                    <th style="width: 15%" >Pagado</th>
                    <th style="width: 10%" >Adeudo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php
                        $pago = new Pago($inscripcion->getIDUltimoPago());
                        echo $pago->recibo;
                        ?>
                    </td>
                    <td><?php echo strftime("%d de %B de %Y", strtotime($inscripcion->fechaUltimoPago())); ?></td>
                    <td>Inscripción</td>
                    <td>$<?php echo number_format($inscripcion->monto, 2); ?></td>
                    <td>$<?php echo number_format($inscripcion->recargos, 2); ?></td>
                    <td>$<?php echo number_format($inscripcion->descuento, 2); ?></td>
                    <td>$<?php echo number_format($inscripcion->monto - $inscripcion->descuento, 2); ?></td>
                    <td>$<?php echo number_format($inscripcion->pagado, 2); ?></td>
                    <td>$<?php echo number_format($adeudo_inscripcion, 2); ?></td>
                </tr>
            <?php
            $adeudo_colegiaturas = 0;
            if(is_array($colegiaturas))
            {
                foreach($colegiaturas as $colegiatura)
                {
                    if(is_null($colegiatura['fecha_ultimo_pago'])) $fecha = "";
                    else $fecha = strftime("%d de %B de %Y", strtotime($colegiatura['fecha_ultimo_pago']));
                    echo "
                    <tr>
                        <td>".$colegiatura['recibo']."</td>
                        <td>".$fecha."</td>
                        <td>".getNombreMes($colegiatura['mes'])."</td>
                        <td>$".number_format($colegiatura['subtotal'], 2)."</td>
                        <td>$".number_format($colegiatura['recargos'], 2)."</td>
                        <td>$".number_format($colegiatura['descuento'], 2)."</td>
                        <td>$".number_format($colegiatura['total'], 2)."</td>
                        <td>$".number_format($colegiatura['pagado'], 2)."</td>
                        <td>$".number_format($colegiatura['adeudo'], 2)."</td>
                    </tr>
                ";

                    $adeudo_colegiaturas += $colegiatura['adeudo'];
                }
            }
            ?>
            </tbody>
        </table>

        <hr />

        <div id="adeudo_total" >
            <label>Adeudo </label>
            $<?php echo number_format($adeudo_colegiaturas + $adeudo_inscripcion, 2); ?>
        </div>

        <button onclick="print()" style="margin: 50px 0 0">Imprimir</button>
    </div>
    </body>
</html>