<?php
session_start(); 
$id = $_GET['id'];
$favorite = $_SESSION['favorite'] ?? array(); 
$favorite[] = $id;
$_SESSION['favorite'] = $favorite;
//var_dump($_SESSION['cart']);
header("Location: index.php");