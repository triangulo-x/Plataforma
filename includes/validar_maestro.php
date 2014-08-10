<?php
session_start();
if(!isset($_SESSION['id_persona'])) header('Location: /login.php');
if($_SESSION['tipo_persona'] < 2) header('Location: /index.php');