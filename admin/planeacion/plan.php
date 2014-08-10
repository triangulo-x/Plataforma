<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */

include_once("../../includes/validar_admin.php");
include_once("../../includes/clases/class_lib.php");
extract($_GET);
# id_plan
$plan = new Plan($id_plan);
?>
<html>
<head>
    <meta charset="utf-8" />
    <title>Sistema Integral Meze - Planeación</title>
    <link rel="stylesheet" href="../../estilo/plan.css" />
</head>
<body>
    <div id="div_informacion">
        <p><b>Grado:</b> <?php echo $plan->getNombreGrado(); ?></p>
        <p><b>Materia:</b> <?php echo $plan->getNombreMateria(); ?></p>
        <p><b>Realizado por:</b> <?php echo $plan->getNombrePlaneador(); ?></p>
    </div>
    <table id="tabla_planeacion">
        <tr id="header" >
            <th></th>
            <th>Tema</th>
            <th>Estrategias</th>
            <th>Métodos de evaluación</th>
        </tr>
    <?php
        for($i = 1; $i <= 5; $i++)
        {
            $flag = 0;
            $temas = $plan->getTemasBloque($i);
            if(is_array($temas))
            {
                foreach($temas as $tema)
                {
                    echo "<tr>";
                    if($flag == 0){ echo "<td class='no_bloque' rowspan='".count($temas)."'>Bloque ".$i."</td>"; $flag = 1; }
                    echo "<td>".$tema->getNombreTema()."</td><td><ul>";

                    $estrategias = $tema->getEstrategias();
                    if(is_array($estrategias))
                    {
                        foreach($estrategias as $estrategia)
                        {
                            echo "<li>".$estrategia['estrategia']."</li>";
                        }
                    }

                    echo "</ul></td><td><ul>";

                    $metodos = $tema->getMetodos();
                    if(is_array($metodos))
                    {
                        foreach($metodos as $metodo)
                        {
                            echo "<li>".$metodo['metodo']."</li>";
                        }
                    }

                    echo "</ul></td>";
                }
            }
            $flag = 0;
        }
    ?>
    </table>
</body>
</html>