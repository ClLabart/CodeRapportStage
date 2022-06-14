<?php
session_start();
require("passwords.php");
$mabd = new PDO('mysql:host=127.0.0.1;port=3306;dbname=vdg_users;charset=UTF8;', LOGIN, MDP);
$mabd->query('SET NAMES utf8;');
if (isset($_SESSION['connect']) == false) {
    $user = $_POST['user'];
    $mdp = $_POST['mdp'];
    $result = $mabd->query('SELECT * FROM users WHERE User_Nom="' . $user . '"');
    $lines_result = $result->rowCount();
    if ($lines_result > 0) {
        while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($mdp, $ligne['User_Pass']) === true) {
                $_SESSION['connect'] = true;
            } else {
                $_SESSION['error'] = "Mot de passe invalide";
                $mabd = null;
                header('Location: index.php?user=' . $user);
                exit;
            }
        }
    } else {
        $_SESSION['error'] = "Nom d'utilisateur invalide";
        $mabd = null;
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <h1>Administration</h1>
    <table>
        <thead>
            <tr>
                <th>Nom d'utilisateur</th>
                <th>Mot de passe</th>
                <th>Centre</th>
                <th>Administrateur ?</th>
                <th>Tous les centres ?</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $tabUsers = $mabd->query("SELECT * FROM users");
            $lines_result = $tabUsers->rowCount();
            if ($lines_result > 0) {
                while ($ligne = $tabUsers->fetch(PDO::FETCH_ASSOC)) {
                    echo ('<tr>');
                    echo ('<th>' . $ligne['User_Nom'] . '</th>');
                    echo ('<th>' . $ligne['User_Pass'] . '</th>');
                    echo ('<th>' . $ligne['User_CTR'] . '</th>');
                    echo ('<th>' . $ligne['User_Admin'] . '</th>');
                    echo ('<th>' . $ligne['User_CTR_All'] . '</th>');
                    echo ('<th><a href="modify.php?user=' . $ligne['User_Nom'] . '">Modifier</a></th>');
                    echo ('<th><a href="delete.php?user=' . $ligne['User_Nom'] . '">Supprimer</a></th>');
                    echo ('</tr>');
                }
            }
            $mabd = null;
            ?>
        </tbody>
        <div class="buttons">
            <a href="create.php">Créer un utilisateur</a>
        </div>
    </table>
</body>

</html>