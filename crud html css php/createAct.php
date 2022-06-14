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
$stmt = $mabd->prepare('INSERT INTO users(User_Nom, User_Pass, User_CTR, User_Admin, User_CTR_All) VALUES (:user, :mdpp, :ctr, :adminn, :ctrall)');
$mdpp = password_hash($_POST['pass'], PASSWORD_DEFAULT);
if (isset($_POST['admin']) == true) {
    $admin = (int)1;
} else {
    $admin = (int)0;
}
if (isset($_POST['centerall']) == true) {
    $ctrall = (int)1;
} else {
    $ctrall = (int)0;
}
$center = (int)$_POST['center'];
$stmt->bindParam(":user", $_POST['name'], PDO::PARAM_STR);
$stmt->bindParam(":mdpp", $mdpp, PDO::PARAM_STR);
$stmt->bindParam(":ctr", $center, PDO::PARAM_INT);
$stmt->bindParam(":adminn", $admin, PDO::PARAM_INT);
$stmt->bindParam(":ctrall", $ctrall, PDO::PARAM_INT);
$stmt->execute();

$madb = null;
header('Location: crud.php');
