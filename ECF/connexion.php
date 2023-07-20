<?php
include("bdd.php");

if (isset($_POST['valider'])) {
    if (!empty($_POST['email']) && !empty($_POST['mdp'])) {
        $email_saisi = htmlspecialchars($_POST['email']);
        $mdp_saisi = htmlspecialchars($_POST['mdp']);

        $connUser = $bdd->prepare("SELECT * FROM membre WHERE user_email = ?");
        $connUser->execute(array($email_saisi));

        if ($connUser->rowCount() > 0) {
            $data = $connUser->fetch(PDO::FETCH_ASSOC);
            if (password_verify($mdp_saisi, $data["user_mdp"])) {
                $_SESSION['mdp'] = $mdp_saisi;
                $_SESSION['email'] = $email_saisi;
                $_SESSION['id'] = $data['id_user'];
                $_SESSION['name'] = $data['user_name'];

                if ($data["admin"] == "user") {
                    header('Location: accueilMembre.php');
                    exit();
                } elseif ($data["admin"] == "admin") {
                    header('Location: accueilAdmin.php');
                    exit();
                }
            } else {
                echo "Votre mot de passe ou email est incorrect";
            }
        } else {
            echo "Votre email n'est pas enregistré";
        }
    } else {
        echo 'Veuillez compléter tous les champs!';
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./style_connexion.css">
</head>

<body>
    <header>
        <nav>
            <div class="navbar">
                <div class="navLeftPart">
                    <img src="./assets/img/logogarage.png" alt="Logo du garage">

                </div>
                <div class="navMidPart">
                    <ul id="service">

                        <li><a href="./index.php#nosServices">Nos services</a></li>
                        <li><a href="./vente.php">Véhicule d'occasion</a></li>
                        <li><a href="./form.php">Nous contacter</a></li>
                    </ul>
                </div>

                <div class="navRightPart">
                    <div class="connect">
                        <a href="./connexion.php">Se connecter</a>
                    </div>
                </div>
            </div>
        </nav>


    </header>
    <main>
        <form action="" method="POST">


            <div class="email-container">
                <label for="email">Email</label>
                <input type="text" autocomplete="off" id="email" name="email">
                <span>Email inncorrect</span>
            </div>

            <div class="password-container">
                <label for="password">Mot de passe</label>
                <input type="password" autocomplete="off" id="password" name="mdp">
                <p id="progress-bar"></p>
                <span></span>
            </div>

            <input type="submit" value="Valider" name="valider">
        </form>
    </main>

    <!-- <script src="./connexion.js"></script> -->

</body>

</html>