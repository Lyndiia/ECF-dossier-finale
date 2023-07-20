<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "fv_database";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    //Définir le mode erreur PDO en exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "connexion echouée : " . $e->getMessage();
}
if (!$_SESSION['mdp']) {
    header('Location:connexion.php');
}

if (isset($_POST['valider'])) {
    if (!empty($_POST['user_name']) and !empty($_POST['user_email']) and !empty($_POST['user_mdp'])) {
        $name = htmlspecialchars($_POST['user_name']);
        $email = htmlspecialchars($_POST['user_email']);
        $mdp = password_hash($_POST['user_mdp'], PASSWORD_DEFAULT);
        $insertUser = $bdd->prepare('INSERT INTO membre (`user_email`, `user_mdp`, `user_name`,`admin`) VALUES (?, ?, ?, ?)');
        $insertUser->execute(array($email, $mdp, $name, "user"));
    } else {
        echo "Veuillez remplir tous les champs!";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des employés</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./formContact.css">
</head>

<body>
    <header>
        <nav>
            <div class="navbar">
                <div class="navLeftPart">
                    <img src="./assets/img/logogarage.png" alt="Logo du garage" />
                </div>
                <div class="navMidPart">
                    <ul id="service">
                        <li><a href="./index.php/#nosServices">Nos services</a></li>
                        <li><a href="./vente.php">Véhicule d'occasion</a></li>
                        <li><a href="./form.php">Nous contacter</a></li>
                    </ul>
                </div>

                <div class="navRightPart">
                    <div class="connect">
                        <a href="./logout.php">Deconnexion</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <h2>Mes employés : </h2>
        <?php
        $recupUsers = $bdd->query('SELECT * FROM membre');
        while ($user = $recupUsers->fetch()) {
        ?>
            <div class="Recup">
                <h3>Nom et Prenom : </h3>
                <p><?= $user['user_name'] ?> <a href="bannir.php?id=<?= $user['id_user'] ?>">Supprimer l'employé</a></p>
            </div>
        <?php
        }
        ?>
        <div class="creationMembre">
            <h2>Créer un nouvel espace employé:</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="user_name">
                    <label for="user_name"> Prenom et Nom : </label>
                    <input type="text" id="user_name" name="user_name" required>
                    <span></span>
                </div>

                <div class="user_emailContainer">
                    <label for="user_email"> adresse email : </label>
                    <input type="text" id="user_email" name="user_email" required>
                    <span></span>
                </div>


                <div class="user_mdpContainer">
                    <label for="user_mdp">Mot de Passe : </label>
                    <input type="text" id="user_mdp" name="user_mdp" required>

                </div>

                <input class="btn" type="submit" name="valider" value="Valider">

            </form>
        </div>
    </main>
</body>

</html>