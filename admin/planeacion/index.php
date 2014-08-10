<?php
include("../../includes/validar_maestro.php");
include_once("../../includes/clases/class_lib.php");
$maestro = new Maestro($_SESSION['id_persona']);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Sistema Integral Meze - Planeación</title>
        <link rel="stylesheet" href="../../estilo/general.css" />
        <link rel="stylesheet" href="../../estilo/jquery.dataTables.css" />
        <style>
            #tabla_planeaciones_wrapper
            {
                font-size: 12px;
            }
        </style>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="../../librerias/jquery.dataTables.min.js" ></script>
        <script src="../../librerias/fnAjaxReload.js" ></script>
        <script>
            var tabla_planeaciones;

            $(document).ready(function ()
            {
                inicializarDataTable();
            });

            function inicializarDataTable()
            {
                tabla_planeaciones = $('#tabla_planeaciones').dataTable({
                    "oLanguage": {
                        "sLengthMenu": "Mostrar _MENU_ planeaciones por página",
                        "sZeroRecords": "No se encontraron planeaciones",
                        "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ planeaciones",
                        "sInfoEmpty": "Mostrando 0 a 0 de 0 planeaciones",
                        "sInfoFiltered": "(Encontrados de _MAX_ planeaciones)"
                    },
                    "aoColumns": [
                        {"sWidth":"30%"},{"sWidth":"30%"},{"sWidth":"35%"},{"sWidth":"5%"}
                    ],
                    "bProcessing": true,
                    "sAjaxSource": '../../includes/acciones/planeacion/get_planeaciones.php'
                });
            }
        </script>
    </head>
    <body>
        <div id="wrapper">
            <?php include("../../includes/header.php"); ?>
            <div id="content">

                <div id="inner_content">

                    <table id="tabla_planeaciones">
                        <thead>
                            <tr>
                                <th>Grado</th>
                                <th>Materia</th>
                                <th>Maestro</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </body>
</html>
