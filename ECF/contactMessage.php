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
    <title>Afficher les demandes</title>
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
    $recupFormulaire = $bdd->query('SELECT * FROM contactMess');
    while ($form = $recupFormulaire->fetch()) {
    ?>
        <div class="Recup">
            <h3>Nom : </h3>
            <p><?= $form['message_name'] ?></p>
            <h3>Numéro : </h3>
            <p><?= $form['message_phone'] ?></p>
            <h3>Email : </h3>
            <p><?= $form['message_email'] ?></p>
            <h3>Sujet de la demande : </h3>
            <p><?= $form['message_sujet'] ?></p>
            <h3>Demande : </h3>
            <p><?= $form['message_commentaire'] ?></p>
            <a href="supprimerDemande.php?id=<?= $form['id_message'] ?>">Supprimer la demande </a>




        </div>
    <?php
    }
    ?>

</body>

</html>