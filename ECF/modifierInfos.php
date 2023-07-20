<?php

session_start();
if (!$_SESSION['mdp']) {
    header('Location:index.php');
}


include("bdd.php");

if (isset($_GET['id']) and !empty($_GET['id'])) {
    $getid = $_GET['id'];
    $recupInfos = $bdd->prepare('SELECT * FROM articles WHERE id_user =?');
    $recupInfos->execute(array($getid));
    if ($recupInfos->rowCount() > 0) {
        $Infos = $recupInfos->fetch();

        $aPropos = str_replace('<br />', '', $Infos['aPropos']);
        $entretien = str_replace('<br />', '', $Infos['entretien']);
        $carrosserie = str_replace('<br />', '', $Infos['carrosserie']);
        $mecanique = str_replace('<br />', '', $Infos['mecanique']);
        $adress = str_replace('<br />', '', $Infos['adress']);
        $telephone = str_replace('<br />', '', $Infos['telephone']);

        if (isset($_POST['valider'])) {
            $saisi_aPropos = nl2br(htmlspecialchars($_POST['aPropos']));
            $saisi_entretien = nl2br(htmlspecialchars($_POST['entretien']));
            $saisi_carrosserie = nl2br(htmlspecialchars($_POST['carrosserie']));
            $saisi_mecanique = nl2br(htmlspecialchars($_POST['mecanique']));
            $saisi_adress = nl2br(htmlspecialchars($_POST['adress']));
            $saisi_telephone = nl2br(htmlspecialchars($_POST['telephone']));

            $updateInfos = $bdd->prepare('UPDATE articles SET aPropos = ?, entretien = ?, carrosserie =?, mecanique = ?, adress= ?, telephone=? WHERE id_user = ?');
            $updateInfos->execute(array($saisi_aPropos, $saisi_entretien, $saisi_carrosserie, $saisi_mecanique, $saisi_adress, $saisi_telephone, $getid));

            header('Location:modificationPrincipale.php');
        }
    } else {
        echo "Aucune informations trouvées";
    }
} else {
    echo "Aucun identifiant trouvé";
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un véhicule</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./modifInfos.css">
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
        <div class="titleContainer">
            <h2>Modifier les informations</h2>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">

            <div class="aProposContainer">
                <label for="aPropos">Partie a propos :</label>
                <textarea name="aPropos" id="aPropos" required>
                    <?= $aPropos; ?>
                </textarea>
            </div>

            <div class="entretienContainer">
                <label for="entretien">Partie entretien : </label>
                <textarea name="entretien" id="entretien" required>
                    <?= $entretien; ?>
                </textarea>
            </div>
            <div class="carrosserieContainer">
                <label for="carrosserie">Partie carrosserie: </label>
                <textarea name="carrosserie" id="carrosserie" required>
                    <?= $carrosserie; ?>
                </textarea>
            </div>
            <div class="mecaniqueContainer">
                <label for="mecanique">Partie mecanique : </label>
                <textarea name="mecanique" id="mecanique" required>
                    <?= $mecanique; ?>
                </textarea>
            </div>
            <div class="adressContainer">
                <label for="adress">Adresse du garage : </label>
                <textarea name="adress" id="adress" required>
                    <?= $adress; ?>
                </textarea>
            </div>

            <div class="telephoneContainer">
                <label for="telephone">Numéro du garage : </label>
                <textarea name="telephone" id="telephone" required>
                    <?= $telephone; ?>
                </textarea>
            </div>


            <input class="btn" type="submit" name="valider" value="Valider">

        </form>
        <br>
        <?php if (isset($message)) {
            echo $message;
        } ?>
    </main>
</body>

</html>