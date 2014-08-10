<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 20/06/14
 * Time: 12:53 PM
 */

$DEBUG = FALSE;

$id_modulo = 17; // Cuentas - Pagos
include_once("../../../includes/validar_admin.php");
include_once("../../../includes/clases/class_lib.php");
include_once("../../../includes/validar_acceso.php");

extract($_GET);
# recibo

$pagos = Cuenta::getPagosDeRecibo($recibo);
$cuenta = new Cuenta($pagos[0]->id_cuenta);
$fecha = $pagos[0]->fecha;
$alumno = new Alumno($cuenta->id_persona);
IF($DEBUG) print_r($alumno);
$total = Cuenta::getTotalRecibo($recibo);
$descuento = Cuenta::getDescuentoRecibo($recibo);

$direccion = $alumno->getDireccion();
$direccion = $direccion['calle']. " ".$direccion['numero']." ".$direccion['colonia'];
$concepto = "";
if(is_array($pagos))
{
    foreach($pagos as $pago)
    {
        if($concepto == "") $concepto = $pago->getConcepto();
        else $concepto .= ", ".$pago->getConcepto();
    }
}
?>
<html>
<head>
    <meta charset="utf-8" />
    <title>Recibo de pago</title>
    <link href="/estilo/recibo.css" rel="stylesheet" />
</head>
<body>
<div id="div_recibo">

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
        <div id="fecha_folio">
            <div class="fecha_folio_header">FOLIO</div>
            <div class="fecha_folio_valor"><?php echo $recibo; ?></div>
            <div class="fecha_folio_header">FECHA</div>
            <div class="fecha_folio_valor"><?php echo strftime("%d-%m-%Y", strtotime($fecha)); ?></div>
        </div>
    </div>

    <div id="main_content" >
        <div class="renglon">
            <div class="renglon_left">RECIBÍ DE:</div>
            <div class="renglon_right"><?php echo $alumno->getNombreCompleto(); ?></div>
        </div>
        <div class="renglon">
            <div class="renglon_left">DOMICILIO:</div>
            <div class="renglon_right"><?php echo $direccion; ?></div>
        </div>
        <div class="renglon">
            <div class="renglon_left">CIUDAD:</div>
            <div class="renglon_right"><?php echo "Torreón"; ?></div>
        </div>
        <div class="renglon">
            <div class="renglon_left">LA CANTIDAD DE:</div>
            <div class="renglon_right"><?php echo Cuenta::numtoletras($total); ?></div>
        </div>
        <div class="renglon">
            <div class="renglon_left">POR EL CONCEPTO DE:</div>
            <div class="renglon_right"><?php echo $concepto; ?></div>
        </div>
    </div>

    <div id="bottom">
        <div id="div_montos">
            <div class="montos_row">
                <div class="montos_left">IMPORTE</div>
                <div class="montos_right">$<?php echo number_format($total, 2); ?></div>
            </div>
            <div class="montos_row">
                <div class="montos_left">DESCUENTO</div>
                <div class="montos_right">$<?php echo number_format(Cuenta::getDescuentoRecibo($recibo), 2); ?></div>
            </div>
            <div class="montos_row">
                <div class="montos_left">TOTAL</div>
                <div class="montos_right">$<?php echo number_format($total, 2); ?></div>
            </div>
        </div>
    </div>

</div>
</body>
</html>