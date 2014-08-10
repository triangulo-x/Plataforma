<?php
session_start();
if(!isset($_SESSION['id_persona'])){ header('Location: /login.php'); exit(); }
if($_SESSION['id_persona'] != 1 && $_SESSION['id_persona'] != 2){ header('Location: /index.php'); exit(); }