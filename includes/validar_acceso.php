<?php
/** Created by Gustavo Carrillo
 * gus@yozki.net
 * @yozki
 */
session_start();

$persona = new Persona($_SESSION['id_persona']);
if(!$persona->accesoModulo($id_modulo))
{
    header('Location: /index.php');
    exit();
}