<?php

session_start();
if (!$_SESSION['mdp']) {
    header('Location:index.php');
}


include("bdd.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher les véhicules existants</title>
    <link rel="stylesheet" href="./style.css">

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

    <?php
    $recupVehicules = $bdd->query('SELECT * FROM vehiculeOccas');
    while ($vehicule = $recupVehicules->fetch()) {
    ?>
        <div class="Recup">
            <h3>Modèle : </h3>
            <p><?= $vehicule['auto_model'] ?></p>
            <h3>Kilométrage : </h3>
            <p><?= $vehicule['auto_km'] ?></p>
            <h3>Prix : </h3>
            <p><?= $vehicule['auto_price'] ?></p>
            <h3>Année de mise en circulation : </h3>
            <p><?= $vehicule['auto_model'] ?></p>
            <a class="btn" href="supprimerVehicule.php?id=<?= $vehicule['id_auto'] ?>">Supprimer la voiture</a>
            <a class="btn" href="modifierVehicule.php?id=<?= $vehicule['id_auto'] ?>">
                Modifier la fiche d'un voiture
            </a>



        </div>
    <?php
    }
    ?>

</body>

</html>