<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 9/05/14
 * Time: 03:16 PM
 */

include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_GET);
#id_alumno

$alumno = new Alumno($id_alumno);
$tutores = $alumno->getTutores();

?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Sistema Integral Meze - Inscribir alumno</title>
        <link rel="stylesheet" href="/estilo/print_inscripcion.css" />
    </head>
    <body>
        <div id="logo_wrapper">
            <img id="logo_meze" src="/media/logos/mezebnc.jpg" alt="Colegio MEZE, A.C." />
        </div>
        <div class="apartado" >
            <div class="apartado_header">Inscripción de alumno</div>
            <div class="apartado_content">
                <div class="renglon" >
                    <div class="propiedad" >Nombre:</div>
                    <div class="valor" ><?php echo $alumno->getNombreCompleto(); ?></div>
                </div>
                <div class="renglon" >
                    <div class="propiedad" >Dirección:</div>
                    <?php
                    $direccion = $alumno->getDireccion();
                    $direccion = $direccion['calle']." ".$direccion['numero']." ".$direccion['colonia']." ".$direccion['CP'];
                    ?>
                    <div class="valor" ><?php echo $direccion; ?></div>
                </div>
                <div class="renglon" >
                    <div class="propiedad" >CURP:</div>
                    <div class="valor" ><?php echo $alumno->getCURP(); ?></div>
                </div>
            </div>
        </div>
        <div class="apartado" >
            <div class="apartado_header">Padres de familia o tutores</div>
            <div class="apartado_content">
                <?
                if(is_array($tutores))
                {
                    foreach($tutores as $tutor)
                    {
                        echo "
                            <div class='renglon'>
                                <div class='propiedad' >".$tutor['tipo_tutor']."</div>
                                <div class='valor' >".$tutor['nombre'].",
                                    ".$tutor['direccion_trabajo'].", ".$tutor['telefonos'].", ".$tutor['celular']."</div>
                            </div>
                        ";
                    }
                }
                ?>
            </div>
        </div>
        <div class="apartado" >
            <div class="apartado_header">Información extra</div>
            <div class="apartado_content">
                <div class='renglon'>
                    <div class='propiedad' >Club deportivo</div>
                    <div class='valor' ><? echo $alumno->getClubDeportivo(); ?></div>
                </div>
            </div>
        </div>
        <div class="apartado" >
            <div class="apartado_header">Beca</div>
            <div class="apartado_content">
                <? $beca = $alumno->getBecaActual();?>
                <div class='renglon'>
                    <div class='propiedad' >Monto</div>
                    <div class='valor' ><? echo $beca['beca']; ?></div>
                </div>
                <div class='renglon'>
                    <div class='propiedad' >Tipo</div>
                    <div class='valor' ><? echo $beca['tipo']; ?></div>
                </div>
            </div>
        </div>
        <div class="apartado">
            <div class="apartado_header">Papeleria entregada</div>
            <div class="apartado_content">
                <table>
                    <thead>
                    <tr>
                        <th>Documento</th>
                        <th style="width: 120px" >Original</th>
                        <th>Copia</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $papeleria = $alumno->getPapeleria();
                    if(is_array($papeleria))
                    {
                        foreach($papeleria as $documento)
                        {
                            $id_documento   = $documento['id_documento'];
                            $nombre         = $documento['documento'];
                            $original = ''; $copia = '';
                            if($documento['original'] == 1) $original = 'checked';
                            if($documento['copia'] == 1) $copia = 'checked';

                            echo "
                                <tr class='documento' >
                                    <input type='hidden' class='id_documento' value='".$id_documento."' />
                                    <td>".$nombre."</td>
                                    <td><input type='checkbox' class='original' value='".$id_documento."' ".$original." disabled /></td>
                                    <td><input type='checkbox' class='copia' value='".$id_documento."' ".$copia." disabled /></td>
                                </tr>
                            ";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="div_firma">Firma del padre o tutor: ______________________________</div>
    </body>
    <script>
        print();
    </script>
</html>