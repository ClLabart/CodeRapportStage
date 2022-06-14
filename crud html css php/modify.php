<?php
session_start();
$user = $_GET['user'];
if (isset($_SESSION['connect']) == false) {
    $_SESSION['error'] = "Vous n'êtes pas connecté.e";
    header('Location: index.php?user=' . $user);
    exit;
}
require("passwords.php");
$mabd = new PDO('mysql:host=127.0.0.1;port=3306;dbname=vdg_users;charset=UTF8;', LOGIN, MDP);
$mabd->query('SET NAMES utf8;');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un utilisateur</title>
</head>

<body>
    <h1>Modifier un utilisateur</h1>
    <form action="modifyAct.php?user=<?php echo($user); ?>" method="POST">
        <?php
        $result = $mabd->query('SELECT * FROM users WHERE User_Nom="' . $user . '"');
        $lines_result = $result->rowCount();
        if ($lines_result > 0) {
            while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                <label for="name">Nom d'utilisateur</label>
                <input type="text" name="name" required value="<?php echo ($ligne['User_Nom']) ?>">
                <label for="pass">Mot de passe</label>
                <input type="text" name="pass" required>
                <label for="ctr">Centre</label>
                <input type="number" name="ctr" required value="<?php echo ($ligne['User_CTR']) ?>">
                <label for="admin">L'utilisateur est-il administrateur ?</label>
                <input type="checkbox" name="admin" <?php if ($ligne['User_Admin'] === true) {
                                            echo ("selected");
                                        } ?>>
                <label for="ctrall">L'utilisateur peut-il accéder à tous les centres ?</label>
                <input type="checkbox" name="ctrall" <?php if ($ligne['User_CTR_All'] === true) {
                                            echo ("selected");
                                        } ?>>
        <?php
            endwhile;
        }
        $mabd = null;
        ?>
        <div class="buttons">
            <input type="submit" value="Valider">
            <a href="crud.php">Retour</a>
        </div>
    </form>
</body>

</html>