<?php
session_start();
if (isset($_SESSION['connect']) == false) {
    $_SESSION['error'] = "Vous n'êtes pas connecté.e";
    header('Location: index.php?user=' . $user);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un utilisateur</title>
</head>
<body>
    <h1>Créer un utilisateur</h1>
    <form action="createAct.php" method="POST">
        <label for="name">Nom d'utilisateur</label>
        <input type="text" name="name" required>
        <label for="pass">Mot de passe</label>
        <input type="text" name="pass" required>
        <label for="center">Centre</label>
        <input type="number" name="center" required>
        <label for="admin">L'utilisateur est-il administrateur ?</label>
        <input type="checkbox" name="admin">
        <label for="centerall">L'utilisateur peut-il accéder à tous les centres ?</label>
        <input type="checkbox" name="centerall">
        <div class="buttons">
            <input type="submit" value="Valider">
            <a href="crud.php">Retour</a>
        </div>
    </form>
</body>
</html>