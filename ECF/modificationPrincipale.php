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
    <title>Informations Principales :</title>
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

        <h2>Informations générales : </h2>

        <a href=""></a>

        <?php
        $recupInfos = $bdd->query('SELECT * FROM articles');
        while ($a = $recupInfos->fetch()) {
        ?>
            <div class="infosPrincipales">

                <div class="container">

                    <h3>A Propos: </h3>
                    <p><?= $a['aPropos'] ?></p>
                </div>

                <div class="container">

                    <h3> Partie entretien : </h3>
                    <p><?= $a['entretien'] ?></p>

                </div>
                <div class="container">

                    <h3>Partie carrosserie : </h3>
                    <p><?= $a['carrosserie'] ?></p>

                </div>
                <div class="container">
                    <h3>Partie mecanique : </h3>
                    <p><?= $a['mecanique'] ?></p>

                </div>
                <div class="container">

                    <h3>Adresse du garage : </h3>
                    <p><?= $a['adress'] ?></p>
                    <h3>Numéro du garage : </h3>
                    <p><?= $a['telephone'] ?></p>
                </div>
                <a class="btn" href="modifierInfos.php?id=<?= $a['id_user'] ?>">Modifier les informations </a>


            </div>
        <?php
        }
        ?>
    </main>
</body>

</html>