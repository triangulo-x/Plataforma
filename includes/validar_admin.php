<?php
if(!isset($_SESSION))
{
    session_start();
}
if(!isset($_SESSION['id_persona']))
{
    header('Location: /login.php');
    exit();
}
if($_SESSION['tipo_persona'] != 3)
{
    header('Location: /index.php');
    exit();
}