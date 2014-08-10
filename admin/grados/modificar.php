<?php
include_once("../../includes/validar_admin.php");
include_once("../../includes/clases/class_lib.php");
$materias = Materia::getLista();
extract($_GET);
#id_grado

$grado = new Grado($id_grado);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Sistema Integral Meze - Nuevo grado</title>
        <link rel="stylesheet" href="../../estilo/general.css" />
        <link rel="stylesheet" href="../../estilo/formas.css" />
        <style>

        </style>
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
                $('#forma_nuevo_grado').validate({
                    rules: {
                        "gradoVal":
                        {
                            required: true
                        }
                    }
                })
            }
        </script>
    </head>
    <body>
        <div id="wrapper">
            <?php include("../../includes/header.php"); ?>
            <div id="content">

                <div id="inner_content">
                    <h1>Modificar grado</h1>
                    <form id="forma_nuevo_grado" action="../../includes/acciones/grados/update.php" method="post" >
                        <div class="form_row_2">
                            <label class="form_label" for="gradoVal">Grado</label>
                            <input type="hidden" name="id_gradoVal" value="<?php echo $grado->id_grado; ?>" />
                            <input type="text" name="gradoVal" id="gradoVal" class="form_input" value="<?php echo $grado->grado; ?>" />
                        </div>
                        <div class="form_row">
                            <input id="boton_aceptar" class="form_submit" type="submit" value="Aceptar" />
                        </div>
                    </form>

                    
                </div>
            </div>
        </div>
    </body>
</html>
