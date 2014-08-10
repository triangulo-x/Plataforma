<?php
    session_start();
    if(!isset($_SESSION['id_persona'])) header('Location: /login.php'); 
?>