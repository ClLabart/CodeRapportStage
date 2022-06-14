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
    <h1>Connexion</h1>
    <form action="crud.php" method="POST">
        <label for="user">Nom d'utilisateur</label>
        <input type="text" name="user" required <?php if (isset($_GET['user']) == true) {
                                                    echo ("value='" . $_GET['user'] . "'");
                                                } ?>>
        <label for="mdp">Mot de passe</label>
        <input type="password" name="mdp" required>
        <div class="buttons">
            <input type="submit" value="Connexion">
        </div>
    </form>
    <p class="Error"><?php if (isset($_SESSION['error']) === true) {
                            echo ($_SESSION['error']);
                        } ?></p>
</body>

</html>