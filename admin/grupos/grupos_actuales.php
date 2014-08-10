<?php
include_once("../../includes/validar_admin.php");
include_once("../../includes/clases/class_lib.php");
$ciclo_actual = CicloEscolar::getActual();
$numero_grupos = $ciclo_actual->getCountGrupos();
$grupos = $ciclo_actual->getGrupos();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Grupos</title>
        <link rel="stylesheet" href="../../estilo/general.css" />
        <link rel="stylesheet" href="../../estilo/jquery.dataTables.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="../../librerias/jquery.dataTables.min.js" ></script>
        <script>
            $(document).ready(function ()
            {
                declararDataTable();
            });

            function declararDataTable()
            {
                $('#tabla_grupos').dataTable({
                    "oLanguage": {
                        "sLengthMenu": "Mostrar _MENU_ grupos por página",
                        "sZeroRecords": "No existen grupos",
                        "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ grupos",
                        "sInfoEmpty": "Mostrando 0 a 0 de 0 grupos",
                        "sInfoFiltered": "(Encontrados de _MAX_ grupos)"
                    }
                });
            }
        </script>
    </head>
    <body>
        <div id="wrapper">
            <?php include("../../includes/header.php"); ?>
            <div id="content">
                
                <div style="margin: 20px 0;">Total de grupos: <? echo $numero_grupos; ?></div>

                <table id="tabla_grupos" >
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Grupo</th>
                            <th>Grado</th>
                            <th>Area</th>
                            <th>Alumnos</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(is_array($grupos))
                        {
                            foreach($grupos as $grupo)
                            {
                                echo "
                                    <tr>
                                        <td>".$grupo['id_grupo']."</td>
                                        <td>".$grupo['grupo']."</td>
                                        <td>".$grupo['grado']."</td>
                                        <td>".$grupo['area']."</td>
                                        <td>".$grupo['alumnos']."</td>
                                        <td>
                                            <a href='grupo.php?id_grupo=".$grupo['id_grupo']."' >
                                                <img src='../../media/iconos/icon_stats.png' alt='G' >
                                            </a>
                                        </td>
                                    </tr>
                                ";
                            }
                        }
                        ?>
                    </tbody>
                </table>

                <a href="nuevo.php" class="link_estilizado" >Agregar grupo</a>

            </div>
        </div>
    </body>
</html>
