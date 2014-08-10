/**
 * Created by Gustavo on 25/01/14.
 * Diferentes funciones para usarse dependiendo del nivel que se va a calificar
 * Dependencias:
 * - Debe de existir la variable inicializada 'id_clase'
 */

/** -------------- Funciones generales -------------- */
var id_area;

function enviarCambios()
{
    alert(id_area);
    //kinder();
}

function kinder()
{
    if(confirm('¿Seguro que desea envias las calificaciones asignadas?'))
    {
        var inserts = new Array();
        var updates = new Array();

        $(".insert").each(function ()
        {
            var name = $(this).attr("name").split("-");
            var calificacion = {};
            calificacion.alumno = name[0];
            calificacion.bimestre = name[1];
            calificacion.calificacion = $(this).val();
            inserts.push(calificacion);
        });

        $(".update").each(function ()
        {
            var name = $(this).attr("name").split("-");
            var calificacion = {};
            calificacion.alumno = name[0];
            calificacion.bimestre = name[1];
            calificacion.calificacion = $(this).val();
            updates.push(calificacion);
        });

        $.post("../includes/acciones/calificaciones/asignar.php", { id_clase: id_clase, inserts: inserts, updates: updates }, function (data)
        {
            if(data == 1) window.location.reload(true);
                else alert("Error");
        });
    }
}