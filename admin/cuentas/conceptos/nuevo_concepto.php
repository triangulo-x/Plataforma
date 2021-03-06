<?php
include("../../../includes/validar_admin.php");
include_once("../../../includes/clases/class_lib.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Sistema Integral Meze - Nuevo Pago</title>
        <link rel="stylesheet" href="../../../estilo/general.css" />
        <link rel="stylesheet" href="../../../estilo/formas.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
        <script src="/librerias/messages_es.js"></script>
        <script>
            $(document).ready(function ()
            {
                asignarReglasValidacion();
            });

            function asignarReglasValidacion()
            {
                $('#forma_nuevo_concepto').validate({
                    rules:
                    {
                        "conceptoVal": { required: true },
                        "monto_sugeridoVal": { number: true }
                    }
                })
            }

        </script>
    </head>
    <body>
        <div id="wrapper">
            <?php include("../../../includes/header.php"); ?>
            <div id="content">

                <div id="inner_content">
                
                    <form action="../../../includes/acciones/cuentas/conceptos/insert.php" method="post" id="forma_nuevo_concepto" >
                        <div class="form_row_2">
                            <label class="form_label">Concepto</label>
                            <input type="text" name="conceptoVal" id="conceptoVal" class="form_input" />
                        </div>
                        <div class="form_row_2">
                            <label class="form_label">Monto sugerido</label>
                            <input type="text" name="monto_sugeridoVal" id="monto_sugeridoVal" class="form_input" />
                        </div>
                        <div class="form_row">
                            <input type="submit" value="Aceptar" class="form_submit" />
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </body>
</html>
