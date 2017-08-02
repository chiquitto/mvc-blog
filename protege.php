<?php

session_start();
if (!isset($_SESSION['idadmin'])) {
    header('location:login.php');
    exit;
}