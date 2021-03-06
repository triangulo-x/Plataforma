<?php
$id_modulo = 2; // Administradores - Ver lista
include_once("../../includes/clases/class_lib.php");
include_once("../../includes/validar_acceso.php");
include_once("../../includes/validar_admin.php");
$administradores = Administrador::getLista();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Sistema Integral Meze - Administradores</title>
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
                $('#tabla_administradores').dataTable({
                    "oLanguage": {
                        "sLengthMenu": "Mostrar _MENU_ administradores por página",
                        "sZeroRecords": "No existen administradores",
                        "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ administradores",
                        "sInfoEmpty": "Mostrando 0 a 0 de 0 administradores",
                        "sInfoFiltered": "(Encontrados de _MAX_ administradores)"
                    }
                });
            }

            function eliminar_administrador(id_administrador)
            {
                if (confirm("¿Seguro que desea eliminar el administrador?. Esta acción es irreversible."))
                {
                    window.location = '../../includes/acciones/administradores/eliminar.php?id_administrador=' + id_administrador;
                }
            }
        </script>
    </head>
    <body>
        <div id="wrapper">
            <?php include("../../includes/header.php"); ?>
            <div id="content">

                <div id="inner_content">
                
                    <h1>Administradores</h1>

                    <button onclick="location.href='nuevo.php'" >Nuevo</button>

                    <table id="tabla_administradores" >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Matrícula</th>
                                <th>Apellido paterno</th>
                                <th>Apellido materno</th>
                                <th>Nombres</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(is_array($administradores))
                            {
                                foreach($administradores as $administrador)
                                {
                                    echo "
                                        <tr>
                                            <td>".$administrador['id_persona']."</td>
                                            <td>".$administrador['matricula']."</td>
                                            <td>".$administrador['apellido_paterno']."</td>
                                            <td>".$administrador['apellido_materno']."</td>
                                            <td>".$administrador['nombres']."</td>
                                            <td onclick='eliminar_administrador(".$administrador['id_persona'].");' >
                                                <img src='../../media/iconos/icon_close.gif' alt='X' >
                                            </td>
                                            <td>
                                                <a href='perfil.php?id_administrador=".$administrador['id_persona']."' >
                                                    <img src='/media/iconos/icon_profile.png' alt='P' />
                                                </a>
                                            </td>
                                        </tr>
                                    ";
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                    <?php if(isset($_GET['error'])) echo '<div class="error">No puede eliminar ese administrador.</div>'; ?>
                </div>

            </div>
        </div>
    </body>
</html>
