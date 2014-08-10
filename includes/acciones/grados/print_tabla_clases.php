<?php
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_POST);
# id_grado

$grado = new Grado($id_grado);
$materias = $grado->getMateriasActuales();
$maestros = Maestro::getLista();

if(is_array($materias))
{
   foreach($materias as $materia)
    {
        echo "
            <div class='clase_row'>
                <input type='hidden' class='id_materiaVal' value='".$materia['id_materia']."' />
                <div class='materiaVal' >".$materia['materia']."</div>
                <select class='maestroVal' >";
                if(is_array($maestros))
                {
                    foreach($maestros as $maestro)
                    {
                        $nombre_maestro = $maestro['nombres'];
                        $nombre_maestro .= " ".$maestro['apellido_paterno'];
                        $nombre_maestro .= " ".$maestro['apellido_materno'];
                        echo "<option value='".$maestro['id_persona']."' >".$nombre_maestro."</option>";
                    }
                }
        echo "  </select>
            </div>
        ";
    } 
}

?>