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
$stmt = $mabd->prepare('UPDATE users SET User_Nom=:user, User_Pass=:mdp, User_CTR=:ctr, User_Admin=:adminn, User_CTR_All=:ctrall) WHERE User_Nom="'.$_GET['user'].'"');
$mdp = password_hash($_POST['pass'], PASSWORD_DEFAULT);
if (isset($_POST['admin']) == true) {
    $admin = 1;
} else {
    $admin = 0;
}
if (isset($_POST['ctrall']) == true) {
    $ctrall = 1;
} else {
    $ctrall = 0;
}
$center = (int)$_POST['ctr'];
$stmt->bindParam(":user", $_POST['name'], PDO::PARAM_STR);
$stmt->bindParam(":mdp", $mdp, PDO::PARAM_STR);
$stmt->bindParam(":ctr", $center, PDO::PARAM_INT);
$stmt->bindParam(":adminn", $admin, PDO::PARAM_INT);
$stmt->bindParam(":ctrall", $ctrall, PDO::PARAM_INT);
$stmt->execute();
$madb = null;
header('Location: crud.php');
