<?php
session_start();
if (isset($_SESSION['connect']) == false) {
    $_SESSION['error'] = "Vous n'êtes pas connecté.e";
    header('Location: index.php?user=' . $user);
    exit;
}
require("passwords.php");
$mabd = new PDO('mysql:host=127.0.0.1;port=3306;dbname=vdg_users;charset=UTF8;', LOGIN, MDP);
$mabd->query('SET NAMES utf8;');
$mabd->query('DELETE FROM users WHERE User_Nom="' . $_GET['user'] . '"');
$madb = null;
header('Location: crud.php');
