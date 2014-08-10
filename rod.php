
<?php

// Variables Globales

// Variable de la barra de estados

$varMarquesina="";

// Conexion a la base de datos y variable de mensaje de error

mysql_connect('localhost','LUIS','')or die ('Ha fallado la conexión: '.mysql_error());

/*Luego hacemos la conexión a la base de datos.
**De igual manera mandamos un msj si hay algun error*/
mysql_select_db('helpdesk')or die ('Error al seleccionar la Base de Datos: '.mysql_error());

// Definimos la variable $msg por seguridad.
$msg = "";

// Muestra las preguntas de la jornada

if(isset($_POST['GPD']))
{
    ?>
    <script type="text/javascript">
        $("#destino").empty();
        aux.close();
    </script>

    <?php
    $varMarquesina = "Se estan visualizando las preguntas de la jornada . . .";
    echo "<div id='contPreguntas'>";

    /* Realizamos la consulta SQL */
    $sql ="select * from preguntasrespuestas";
    $sql3="select * from lideres where id_lider = 3 ";


    $resultadoNombre = mysql_query($sql3) or die(mysql_error());
    $result= mysql_query($sql) or die(mysql_error());

    if(mysql_num_rows($result)==0) die("No hay registros para mostrar");

    /* Desplegamos cada uno de los registros dentro de una tabla */
    echo "<table class='titulos' border=1 cellpadding=4 cellspacing=0>";

    /*Priemro los encabezados*/
    echo "<tr class='headers'>
			 <th colspan=4> Preguntas  </th>
		   <tr >
			 <th> Pregunta </th><th> Respuesta </th><th> Lider responsable </th><th> Fecha </th>
			 
		  </tr></table>";
    echo "<div class='contiene_tabla'>
		  <table>";

    /*Y ahora todos los registros */
    $row2=mysql_fetch_array($resultadoNombre);
    while($row=mysql_fetch_array($result))
    {


        echo "<tr>
			 <td align='right'>  $row[pregunta] </td>
			 <td> $row[respuesta] </td>
			 <td> 
				  $row2[nomUsuario]
			 </td>
			 <td> 
				  $row[fecha]
			 </td>
		   
		  </tr>";
    }
    echo "</table> </div> </div> <br><br>";

}

// Modulo de busqueda personalizada

if(isset($_POST['A12']))
{
    $varMarquesina = "Tiene abierto el modulo de la busqueda personalizada, puede volver a ver las preguntas de la jornada presionando la otra pestaña. . .";
    ?>
    <script language="javascript" type="text/javascript">

        aux = window.open('listaValor.html','Modulo de busqueda . . .','width=600, height=380')

    </script>

<?php
}

// APD -- Argegar pregunta Ayuda

if(isset($_POST['A1']))
{

    // Verificamos que no alla ningun dato sin rellenar.
    if(!empty($_POST['area']) || !empty($_POST['equipo']) || !empty($_POST['pregunta']))
    {

        // Pasamos los datos de los POST a Variables, y le ponemos seguridad.
        $equipo = htmlentities($_POST['tipo']);
        $pregunta = htmlentities($_POST['pregunta']);
        $area = htmlentities($_POST['area']);

        $respuesta = "";

        session_start();
        $fecha = date("d/m/Y") ;
        $hora =  date("G:i:s");
        $FH = $fecha."' '".$hora;
        $usu2="'".$_SESSION['usuario']."'";

        $id_usu= "select id_ejecutivo from ejecutivos where nomUsuario = " .$usu2;
        $aux = mysql_query($id_usu) or die(mysql_error());
        $r = mysql_fetch_array($aux);


        $sql = "INSERT INTO preguntasrespuestas(pregunta, respuesta, equipo, area,fecha, fk_id_ejecutivo) VALUES ('".$pregunta."','".$respuesta."','".$equipo."','".$area."','".$FH."','".$r['id_ejecutivo']."')";

        mysql_query($sql) or die(mysql_error()); // Ejecutamos sentencia sql

        $auxP="'".$pregunta."'";
        $IDPRE = mysql_query("SELECT *
							      FROM preguntasrespuestas
								  where pregunta = " .$auxP) or die(mysql_error());

        $idAux = mysql_fetch_array($IDPRE);

        $sqlBandera = mysql_query("UPDATE banderas
				           SET id_pregunta = '".$idAux['id_pregunta']."'");


        $_SESSION['idPregunta']=$idAux['id_pregunta'];



        // Mostramos un mensaje diciendo que todo salio como lo esperado
        $msg = "Persona agendada correctamente";


        // Variables para la segunda sentencia sql para agregar la peticion de ayuda

        $fecha = date("d/m/Y");
        $hora  = date("G:i:s");
        $horaAux = $hora;
        $HA="'".$horaAux."'";

        $sql2 = "INSERT INTO solicitaayuda(fecha, tiempo_PedirAyuda, tiempo_LlegaAyuda, tiempo_TerminaAyuda, fk_id_ejecutivo, fk_id_lider) VALUES ('".$fecha."','".$hora."',0,0,'".$r['id_ejecutivo']."',3)";

        mysql_query($sql2) or die(mysql_error());

        $IDSOL = mysql_query("SELECT *
							      FROM solicitaayuda
								  where tiempo_PedirAyuda = " .$HA) or die(mysql_error());

        $idAuxSol = mysql_fetch_array($IDSOL);

        $_SESSION['idAyuda']=$idAuxSol['id_ayuda'];


        // codigo para asignar peticion

        $sqlBandera = "UPDATE banderas
				           SET B_activo = 1";

        //$SS="'".$_SESSION['idAyuda']."'";

        $actualizarBandera = mysql_query("UPDATE banderas
                                  SET B_id_ayuda = ".$_SESSION['idAyuda']);


        mysql_query($sqlBandera) or die(mysql_error()); // Ejecutamos sentencia sql


        $varMarquesina = "Se envio correctamente la peticion de ayuda en unos momentos se le dara asistencia"; // Marquesina de barra de estados
        ?>
        <script language="javascript" type="text/javascript">
            time=setInterval(cron, 2000); //cada 5 segundos llamará a la función
            //cron();
        </script>
    <?PHP
    } else {
        // Si hay un dato sin rellenar mostramos el siguiente texto.
        $msg = "Falta rellenar algun dato";
    }
}
else

    // Toma el tiempo en que termina ayuda

    if(isset($_POST['CAYUDA']))
    {
        $hora  = date("G:i:s");

        // sentencia para actualizar dato de la hora en que llega Lider
        session_start();

        $sql3 = "UPDATE solicitaayuda
				SET tiempo_TerminaAyuda = '".$hora."'
				WHERE id_ayuda = ". $_SESSION['idAyuda'];

        $sqBA = "UPDATE banderas
				SET B_activo = 0
				";

        $sqlBP = "UPDATE banderas
				   SET B_Lider_Presencial = 0";

        $sqlBL = "UPDATE banderas
				   SET B_Lider_linea = 0";

        $sqX = "UPDATE banderas
				   SET B_Respuesta_lider = 0";

        mysql_query($sqX) or die(mysql_error());
        mysql_query($sql3) or die(mysql_error());
        mysql_query($sqBA) or die(mysql_error());
        mysql_query($sqlBP) or die(mysql_error());
        mysql_query($sqlBL) or die(mysql_error());

        $varMarquesina = "La ayuda se concreto satisfactoriamente . . .   En espera de la siguiente solicitud de ayuda . . .";
        ?>
        <script language="javascript" type="text/javascript">
            clearInterval(time);
        </script>
    <?php
    }

// Firma Presencial del Lider

if(isset($_POST['FPL']))
{
    // Verificamos que no alla ningun dato sin rellenar.
    if( !empty($_POST['password']))
    {

        $aux2 = $_POST['password'];

        //lineas nuevas
        $idDEpassword = mysql_query("SELECT * FROM lideres WHERE password = '".$aux2."'");

        if($rowID = mysql_fetch_array($idDEpassword)) {

            $aux3 = $rowID['id_lider'];

            $idDEbanderLider = mysql_query("SELECT * FROM banderas WHERE B_sesion = 1 AND id_lider = '".$aux3."'");

            if($rowID2 = mysql_fetch_array($idDEbanderLider)) {


                $hora  = date("G:i:s");
                //	'".$aux3."'
                // sentencia para actualizar dato de la hora en que llega Lider
                session_start();
                $sql3 = "UPDATE solicitaayuda
									SET tiempo_LlegaAyuda = '".$hora."'
									WHERE id_ayuda = ". $_SESSION['idAyuda'];


                $actualizarBandera = "UPDATE banderas
                                                 SET B_Lider_presencial = 0
												 WHERE id_lider = '".$rowID2['id_lider']."'";

                mysql_query($sql3) or die(mysql_error());
                mysql_query($actualizarBandera) or die(mysql_error());

                // Mostramos un mensaje diciendo que todo salio como lo esperado



                $varMarquesina = "Se firmo correctamente el lider $rowID[nomUsuario] le dara la asistencia . . . ";

            }
            else {

                ?>
                <script language="javascript" type="text/javascript">
                    alert("Contraseña incorrecta !!!");
                </script>
            <?php
            }

        }
        //lineas nuevas



    } else {
        // Si hay un dato sin rellenar mostramos el siguiente texto.
        ?>
        <script language="javascript" type="text/javascript">
            alert("Verifique que no falte campos de llenar");
        </script>
    <?php

    }
}

mysql_close();
?>

<!-- ETIQUETAS INICIALES DEL HTML JUNTO CON LA LLAMADA A LOS CSS Y LAS LIBRERIAS DE JQUERY Y JAVASCRIPT  -->

<!DOCTYPE HTML>
<html ><head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>Menu desplegable</title>
<link rel="stylesheet" href="css/StyleTablaInfo.css">
<link rel="stylesheet" href="css/StyleEjecutivo.css">
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="ajax.js"> </script>

<script language="javascript" type="text/javascript">

    // funciones del javascript

    // funcion del reloj

    function mueveReloj() {

        momentoActual = new Date()
        hora = momentoActual.getHours()
        minuto = momentoActual.getMinutes()
        segundo = momentoActual.getSeconds()

        str_segundo = new String (segundo)
        if (str_segundo.length == 1)
            segundo = "0" + segundo

        str_minuto = new String (minuto)
        if (str_minuto.length == 1)
            minuto = "0" + minuto

        str_hora = new String (hora)
        if (str_hora.length == 1)
            hora = "0" + hora

        horaImprimible = hora + " : " + minuto + " : " + segundo

        document.form_reloj.reloj.value = horaImprimible

        setTimeout("mueveReloj()",1000)
    }

</script>


<script language="javascript" type="text/javascript">

    // Funcion que realiza la llamada a mi_php para cargar la consulta personalizada de las preguntas


    function enviar_variables(Bandera,Varea,Vtipo,Vfi,Vff) {

        //alert("entraste al Query");
        try {
            jQuery(document).ready(function() {
                //alert("jQuery esta funcionando !!");
                $("#destino").empty();


                try {
                    //  alert("se cargara la funcion load");
                    $("#destino").load("../CFE/mi_php.php",{bandera: Bandera, area: Varea, tipo: Vtipo, f1: Vfi, f2: Vff}); }
                catch(e){
                    alert("Fallo cargar load");

                }
                //alert("jQuery esta funcionando  2!!");

            });( jQuery );

        }
        catch(e) {
            alert("NO HAY PREGUNTAS CON ESE CRITERIO DE BUSQUEDA . . . ");

        }
    }


    // Funcion de select


    function cargarSelect2(valor)
    {
        alert("entro a select");
        /**
         * Este array contiene los valores sel segundo select
         * Los valores del mismo son:
         *  - hace referencia al value del primer select. Es para saber que valores
         *  mostrar una vez se haya seleccionado una opcion del primer select
         *  - value que se asignara
         *  - testo que se asignara
         */
        var arrayValores=new Array(
            new Array(1,1,"Ubicacion y horario de sucursales"),
            new Array(1,2,"Navegacion en el portal de internet"),
            new Array(1,3,"Informacion general"),
            new Array(1,4,"Informacion de otras dependencias"),
            new Array(1,5,"Equipos de atencion al cliente"),
            new Array(1,6,"Programas de apoyo ahorro al cliente"),
            new Array(2,1,"Tarifas en baja tension"),
            new Array(2,2,"Tarifas horarias"),
            new Array(2,3,"Facturacion en ventanilla y ajustes de facturacion"),
            new Array(2,4,"Leyes y Reglamentos"),
            new Array(3,1,"Formas de pago"),
            new Array(3,2,"Informacion de la factura"),
            new Array(4,1,"Normas de instalacion"),
            new Array(4,2,"Consulta de informacion"),
            new Array(4,3,"Cargo por deposito de garantia"),
            new Array(5,1,"SIAD"),
            new Array(5,2,"Composicion del sistema electrico"),
            new Array(5,3,"Componentes de la linea de distribucion primaria"),
            new Array(5,4,"Procedimientos para aparatos dañados"),
            new Array(6,1,"Equipos de medición"),
            new Array(6,2,"Solicitudes de servicio"),
            new Array(6,3,"Identificacion de desperfectos e interrupciones del sistema"),
            new Array(6,4,"Sistema SICOSS"),
            new Array(7,1,"Manejo de clientes dificiles"),
            new Array(7,2,"Manejo de equipo de computo y/o sistemas comerciales")

        );

        if(valor==0)
        {
            alert("entro a if 0");
            // desactivamos el segundo select
            document.getElementById("tipo").disabled=true;
        }else{
            alert("entro a if else del cero");
            // eliminamos todos los posibles valores que contenga el select2
            document.getElementById("tipo").options.length=0;

            // añadimos los nuevos valores al select2
            document.getElementById("tipo").options[0]=new Option("Selecciona una opcion", "0");
            for(i=0;i<arrayValores.length;i++)
            {
                alert("carga valor del select");
                // unicamente añadimos las opciones que pertenecen al id seleccionado
                // del primer select
                if(arrayValores[i][0]==valor)
                {
                    document.getElementById("tipo").options[document.getElementById("tipo").options.length]=new Option(arrayValores[i][2], arrayValores[i][1]);
                }
            }

            // habilitamos el segundo select
            document.getElementById("tipo").disabled=false;
        }
    }

    /**
     * Una vez selecciona una valor del segundo selecte, obtenemos la información
     * de los dos selects y la mostramos
     */
    function s()
    {
        alert("entraste");

        var v1 = document.getElementById("area");
        var valor1 = v1.options[v1.selectedIndex].value;
        var text1 = v1.options[v1.selectedIndex].text;
        var v2 = document.getElementById("tipo");
        var valor2 = v2.options[v2.selectedIndex].value;
        var text2 = v2.options[v2.selectedIndex].text;

    }



    function mostrar(id){
        document.getElementById(id).style.display="block";
    }

</script>

<!-- ESTILO (css) de los input text y botones -->

<style>
    .body{

        resize:none;
    }
    .textbox
    {
        border: 1px solid #DBE1EB;
        font-size: 13px;
        font-family: Arial, Verdana;
        padding-left: 7px;
        padding-right: 7px;
        padding-top: 10px;
        padding-bottom: 10px;
        border-radius: 4px;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        -o-border-radius: 4px;
        background: #FFFFFF;
        background: linear-gradient(left, #FFFFFF, #F7F9FA);
        background: -moz-linear-gradient(left, #FFFFFF, #F7F9FA);
        background: -webkit-linear-gradient(left, #FFFFFF, #F7F9FA);
        background: -o-linear-gradient(left, #FFFFFF, #F7F9FA);
        color: #2E3133;
    }
    #TITULO {
        color:#0F0;
        font-size:24px;
        font-style:inherit;

    }
    #contenido {
        float:left;
        margin-top:-120px;
        margin-left:60px;
    }

    #contenidoFP {
        float:right;
        margin-top:-90px;
        margin-right:90px;
    }

    .textbox:hover
    {
        color: #2E3133;
        border-color: #FBFFAD;
    }
</style>

</head>
<body >
<br><br>

<!-- Label  para  el  titulo -->

<div id="TITULO">
    <!-- <label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   M O D U L O   &nbsp;&nbsp;&nbsp;      D E   &nbsp;&nbsp;&nbsp;      E J E C U T I V O </label> -->
</div>

<!-- DIV de pedir ayuda al lider  -->

<div id="contPedirAyuda">
    <form id="contSolicitarAyuda" name="enviarPregunta" method="post" actin="" onSubmit="return validar(this)">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <!--<input type="button" name="button2" id="button2" value="  S O L I C I T A R     A Y U D A  "><br><br> -->
        <BR>
        <BR>
        <BR>
        <BR>
        <BR>
        <BR>
        <label for="area">Area:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <select name="area" id="area" onChange="cargarSelect2(this.value);"  >
            <OPTION value="0">Selecciona una opción</OPTION>
            <OPTION value="1">Informacion sobre la empresa</OPTION>
            <OPTION value="2">Facturacion</OPTION>
            <OPTION value="3">Cobranza</OPTION>
            <option value="4">Contratacion</option>
            <OPTION value="5">Distribucion</OPTION>
            <OPTION value="6">ISC-Medicion</OPTION>
            <option value="7">Atencion al Cliente</option>

        </select>
        <br>
        <br>
        <label for="area2">Tipo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <select name="tipo"  id="tipo" onChange="s();" disabled>
            <OPTION value="0">Selecciona una opción</OPTION>

        </select>
        <br>
        <br>
        <label for="pregunta" >Pregunta:</label>
        &nbsp;&nbsp;
        <textarea ROWS=6 COLS=52 name="pregunta" class="textbox" placeholder="Escribe tu pregunta"></textarea>
        <br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <input type="submit" name="A1" value=" E N V I A R      P R E G U N T A " >
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
        <input type="submit" name="CAYUDA" value=" T E R M I N A R   A Y U D A   " >
    </form>
</div>
<br>

<!-- codigo de espacio  -->

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


<!-- DIV   R E L O J   D I G I T A L  -->

<div id="reloj">

</div>

<!-- DIV   Menu donde se cierra sesion -->

<div id="contenedor">
    <center>
        <ul class="nav">
            <li> <a href="Logout.php">Cerrar Sesion<span class="flecha">&#9660;</span></a> </li>
        </ul>
    </center>
</div>

<!-- DIV   Barra de Estado  -->

<div id="barra_estado">
    <MARQUEE  BGCOLOR="#000000" WIDTH=50% HEIGHT=40> <?php echo $varMarquesina; ?> </MARQUEE>
</div>


<!-- DIV    Firma presencial ERRORRR-->

<div id="div1">
    <form id="firmaPresencial" name="frmPresencial" method="post" actin="" onSubmit="return validar(this)">
        <!--<label for="equipo">Lider:</label>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="usuario" value="" class="textbox" placeholder="Usuario"/>
        <br><br><br>
        <label for="equipo">Password:</label>
         &nbsp;
        <input type="password" name="password" value="" class="textbox" placeholder="Contraseña"/>
        <br>
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" name="FPL" value="                Firmar                "onclick="return ToggleDIV()">

        </form>-->
</div>


<!-- DIV    Botones para mandar llamar las busquedas ya sea personalizada o las de la jornada de trabajo -->

<div id="frm_busqueda">
    <form id="contSolicitarAyuda" name="enviarPregunta" method="post" actin="" onSubmit="return validar(this)">
        <input type="submit" name="A12" value="     Iniciar Busqueda Personalizada     ">
    </form>
    <br>
</div>

<div id="frm_busquedaActual">
    <form id="contSolicitarAyuda" name="enviarPregunta" method="post" actin="" onSubmit="return validar(this)">
        <input type="submit" name="GPD" value="     Generar   Preguntas  Del   Dia      "  >
    </form>
    <br>
</div>

<!-- DIV    Donde se alojara respuesta de ser en linea -->

<div id="contenido">

</div>

<!-- DIV    Donde se alojara firma presencial -->

<div id="contenidoFP">

</div>

<!-- DIV    Contenedor de la respuesta personalizada -->

<div class="ayuda" id="destino"></div>

</body>
</html>
