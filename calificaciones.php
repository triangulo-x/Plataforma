<?php
include_once("includes/clases/class_lib.php");
session_start();
if(!isset($_SESSION['id_persona'])) header('Location: index.php');
if($_SESSION['tipo_persona'] != 1) header('Location: index.php');
$alumno = new Alumno($_SESSION['id_persona']);
$materias = $alumno->getMateriasCursando();
?>

<!DOCTYPE html>
<meta charset="utf-8"/>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Calificaciones</title>
        <link rel="stylesheet" href="estilo/general.css" />
        <link rel="stylesheet" href="estilo/calificaciones.css" />
    </head>
    <body>
        
        <div id="wrapper">
            <?php include("includes/header.php"); ?>

            <div id="content">

                <div id="datos_alumno">
                    <div class="dato_alumno">
                        <div class="label">Nombre(s)</div>
                        <div class="value"><?php echo $_SESSION['nombres']; ?></div>
                    </div>
                    <div class="dato_alumno">
                        <div class="label">Apellido paterno</div>
                        <div class="value"><?php echo $_SESSION['apellido_paterno']; ?></div>
                    </div>
                    <div class="dato_alumno">
                        <div class="label">Apellido materno</div>
                        <div class="value"><?php echo $_SESSION['apellido_materno']; ?></div>
                    </div>
                    <div class="dato_alumno">
                        <div class="label">Grado</div>
                        <div class="value"><?php echo $_SESSION['grado']; ?></div>
                    </div>
                    <div class="dato_alumno">
                        <div class="label">Grupo</div>
                        <div class="value"><?php echo $_SESSION['grupo']; ?></div>
                    </div>
                </div>

                <table id="tabla_calificaciones">
                    <thead>
                        <tr>
                            <th style="width: 250px;">Asignatura</th>
                            <th>I</th>
                            <th>II</th>
                            <th>III</th>
                            <th>IV</th>
                            <th>V</th>
                            <th>Promedio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(is_array($materias))
                            {
                                foreach($materias as $materia)
                                {
                                    echo "
                                        <tr>
                                            <td class='asignatura' >".$materia['materia']."</td>
                                    ";

                                    $promedio_materia = 0;

                                    $id_clase = Clase::getClase($alumno->id_grupo, $materia['id_materia']);

                                    for($bimestre = 1; $bimestre <= 5; $bimestre++)
                                    {
                                        $calificacion = $alumno->getCalificacion($id_clase, $bimestre);
                                        echo "<td class='calificacion' >".$calificacion."</td>";
                                        $promedio_materia += $calificacion;
                                    }

                                    $promedio_materia /= 5;
                                    echo "
                                            <td class='promedio' >".number_format($promedio_materia, 1, '.', '')."</td>
                                        </tr>
                                    ";
                                }
                            }
                            else
                            {
                                echo "<div id='mensaje_no_calificaciones' >No tiene calificaciones disponibles en este momento</div>";
                            }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>

    </body>
</html>