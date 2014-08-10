/**
 * Created by Gustavo on 6/02/14.
 * Funciones y variables necesarias para calificar un grupo de kinder
 */

id_area = 1;

var parcial_seleccionado = 0;
var id_alumno_seleccionado = 0;

function seleccionarParcial(parcial, caller)
{
    var temp_seleccionado_anterior = parcial_seleccionado;
    parcial_seleccionado = parcial;

    if(id_alumno_seleccionado != 0 && parcial_seleccionado != 0)
    {
        if(confirm("¿Seguro que desea cargar el reporte del alumno seleccionado?"))
        {
            cargarCalificaciones();
            $(".parcial").each(function()
            {
                $(this).removeClass('seleccionado');
            });
            $(caller).addClass('seleccionado');
        }
        else parcial_seleccionado = temp_seleccionado_anterior;
    }
    else
    {
        $(".parcial").each(function()
        {
            $(this).removeClass('seleccionado');
        });
        $(caller).addClass('seleccionado');
    }
}

function seleccionarAlumno(id_alumno, caller)
{
    var temp_alumno_seleccionado = id_alumno_seleccionado;
    id_alumno_seleccionado = id_alumno

    if(id_alumno_seleccionado != 0 && parcial_seleccionado != 0)
    {
        if(confirm("¿Seguro que desea cargar el reporte del alumno seleccionado?"))
        {
            cargarCalificaciones();
            $(".alumno").each(function()
            {
                $(this).removeClass('seleccionado');
            });
            $(caller).addClass('seleccionado');
        }
        else id_alumno_seleccionado = temp_alumno_seleccionado;
    }
    else
    {
        $(".alumno").each(function()
        {
            $(this).removeClass('seleccionado');
        });
        $(caller).addClass('seleccionado');
    }
}

function cargarCalificaciones()
{
    $.ajax({
        type: "POST",
        url: "/includes/acciones/calificaciones/print_kinder_parcial.php",
        data: "id_grupo=" + id_grupo + "&id_parcial=" + parcial_seleccionado + "&id_alumno=" + id_alumno_seleccionado,
        success: function (data)
        {
            $("#tabla_calificaciones").html(data);
            $("textarea").focus(function(){ $(this).animate({height: "100px"}, 500); });
            $("textarea").blur(function(){ $(this).animate({height: "20px"}, 500); });
        }
    });
}

function enviarCambios()
{
    if(confirm("¿Seguro que desea enviar los cambios?"))
    {
        // Crear un JSON con id_alumno: reporte
        var reportes = [];

        $("#tabla_calificaciones tr").each(function()
        {
            var reporte = {};
            reporte.id_materia = $(this).children('td').children('.param_id_materia').val();
            reporte.reporte = $(this).children('td').children('textarea').val();
            if(reporte.reporte.length > 0) reportes.push(reporte);
        });

        $.ajax({
            type: "POST",
            url: "/includes/acciones/calificaciones/calificar_kinder.php",
            data: "id_grupo=" + id_grupo + "&id_parcial=" + parcial_seleccionado + "&id_alumno=" + id_alumno_seleccionado
                + "&reportes=" + JSON.stringify(reportes),
            success: function (data)
            {

            }
        });
    }

}