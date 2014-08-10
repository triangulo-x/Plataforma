<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

include_once("includes/clases/class_lib.php");
?>
<html>
<head>
    <meta charset="utf-8" />
    <style>
        @media print
        {
            div{
                page-break-inside: avoid;
            }
        }

        #circular
        {
            font-family: arial,helvetica;
            margin: 0 auto;
            /*width: 80%; */
            border-bottom: 1px solid black;
            overflow: auto;
            margin: 30px auto;
            float: left;
            font-size: 12px;
        }

        #saludo
        {
            float: left;
        }

        #fecha
        {
            float:right;
        }

        #cuerpo
        {
            float: left;
            margin: 40px 0;
            text-align: justify;
        }

        #firma
        {
            float: left;
            overflow: auto;
            text-align: center;
            width: 100%;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<?php
$query = "SELECT * FROM adeudos";
$adeudos = Database::select($query);
foreach($adeudos as $adeudo)
{
    echo '
        <div id="circular">
            <div id="saludo">Estimados Padres de Familia:</div>
            <div id="fecha">03 de Diciembre de 2013</div>
            <div id="cuerpo">
                Por medio de la presente le informo que su hijo (a) '.$adeudo["nombre"].' tiene un adeudo pendiente de Material,
                Batería de Exámenes, Impuesto a la Educación y el Servicio de AR que se tuvo que liquidar a mas tardar el
                15 de Septiembre de 2013. Por lo que se le pide de favor pasar a liquidar el dia miércoles 4 de Diciembre
                de 2013, de no ser así no se le permitirá la entrada a su hijo(a) al plantel educativo. De antemano, gracias.
            </div>
            <div id="firma">
                ATENTAMENTE
                <br />
                DPTO. ADMINISTRATIVO
            </div>
        </div>
    ';
}
?>
</body>
</html>