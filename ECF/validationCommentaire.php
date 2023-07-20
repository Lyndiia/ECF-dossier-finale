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
    <main>

        <h2>Informations générales : </h2>

        <?php
        $recupAvis = $bdd->query('SELECT * FROM avis');
        while ($a = $recupAvis->fetch()) {
        ?>
            <div class="Recup">
                <h3>Nom : </h3>
                <p><?= $a['avis_name'] ?></p>
                <h3>Note : </h3>
                <p><?= $a['avis_note'] ?></p>
                <h3>Commentaire : </h3>
                <p><?= $a['avis_comm'] ?></p>

                <a href="supprimerAvis.php?id=<?= $a['id_avis'] ?>">Supprimer l'avis </a>
                <a href="validerAvis.php?id=<?= $a['id_avis'] ?>">Valider l'avis </a>



            </div>
        <?php
        }
        ?>
        <div class="formComm">
            <div class="titleComm">
                <h2>Laissez-nous un avis :</h2>
            </div>
            <div class="formCommContainer">


                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="name-containerComm">
                        <label for="avis_name"> Nom:</label>
                        <input type="text" name="avis_name" autocomplete="off" id="avis_name" />
                        <span></span>
                    </div>


                    <div class="etoile">
                        <label for="avis_note">Choississez votre note sur 5 &#9733 : </label>
                        <select name="avis_note" id="avis_note">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>

                        </select>


                    </div>

                    <div class="messageComm">
                        <label for="avis_comm">Commentaire</label>
                        <textarea rows="10" name="avis_comm" id="avis_comm" cols="40" maxlenght="150"></textarea>
                    </div>

                    <input class="btn" type="submit" name="valider" value="Valider" />
                </form>
            </div>
        </div>
        </div>
    </main>
</body>

</html>