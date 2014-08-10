<?php
include_once("../../validar_admin.php");
include_once("../../clases/class_lib.php");
extract($_POST);
// parametro

$alumnos = Alumno::buscarAlumnos($parametro);

echo "
    <thead>
        <tr>
            <th style='width: 100px;' >Matrícula</th>
            <th>Nombre</th>
        </tr>
    </thead>
    <tbody>
";

foreach($alumnos as $alumno)
{
    echo "
        <tr ondblclick='seleccionarAlumno(".$alumno['id_persona'].")' >
            <td>".$alumno['matricula']."</td>
            <td>".$alumno['apellido_paterno']." ".$alumno['apellido_materno']." ".$alumno['nombres']."</td>
        </tr>
    ";
}

echo "</tbody>";