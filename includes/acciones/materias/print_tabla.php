<?php
include_once("../../clases/class_lib.php");
extract($_POST);
// parametroVal

$materias = Materia::getListaParametro($parametroVal);

echo "
    <thead>
        <tr>
            <th>ID</th>
            <th>Materia</th>
        </tr>
    </thead>
    <tbody>
";

foreach($materias as $materia)
{
    echo "
        <tr ondblclick='asignarMateria(".$materia['id_materia'].", \"".$materia['materia']."\");' >
            <td>".$materia['id_materia']."</td>
            <td>".$materia['materia']."</td>
        </tr>
    ";
}

echo "</tbody>";

?>