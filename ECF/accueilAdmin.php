<?php
session_start();
if (!$_SESSION['mdp']) {
    header('Location:connexion.php');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil Administrateur</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./accueil.css">
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
                        <li><a chref="./index.php/#nosServices">Nos services</a></li>
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
        <h2>Accueil Administration</h2>

        <div class="container">

            <h4>Employés : </h4>
            <a href="employes.php">Afficher la liste des employés</a>

        </div>

        <div class="container">

            <h4>Informations générales : </h4>
            <a href="modificationPrincipale.php">Modifier les informations principales</a>

        </div>

        <div class="container">

            <h4>Véhicules d'occasion : </h4>
            <a href="RedactionArticleVehicule.php">Mettre en ligne un nouveau véhicule</a> <br>
            <a href="afficherVehicule.php">Afficher les véhicules existants</a>

        </div>
        <div class="container">
            <h4>Clients : </h4>
            <a href="contactMessage.php">Afficher les demandes par formulaire</a><br>
            <a href="validationCommentaire.php">Afficher les commentaires</a>
        </div>
    </main>

</body>

</html>