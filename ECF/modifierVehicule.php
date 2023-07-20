<?php

session_start();
if (!$_SESSION['mdp']) {
    header('Location:index.php');
}


include("bdd.php");

if (isset($_GET['id']) and !empty($_GET['id'])) {
    $getid = $_GET['id'];
    $recupVehicule = $bdd->prepare('SELECT * FROM vehiculeOccas WHERE id_auto =?');
    $recupVehicule->execute(array($getid));
    if ($recupVehicule->rowCount() > 0) {
        $vehiculeInfos = $recupVehicule->fetch();

        $model = $vehiculeInfos['auto_model'];
        $years = $vehiculeInfos['auto_years'];
        $km = $vehiculeInfos['auto_km'];
        $price = $vehiculeInfos['auto_price'];
        $desc = str_replace('<br />', '', $vehiculeInfos['auto_description']);

        if (isset($_POST['valider'])) {
            $saisi_model = htmlspecialchars($_POST['auto_model']);
            $saisi_years = htmlspecialchars($_POST['auto_years']);
            $saisi_km = htmlspecialchars($_POST['auto_km']);
            $saisi_price = htmlspecialchars($_POST['auto_price']);
            $saisi_desc = nl2br(htmlspecialchars($_POST['auto_description']));

            $updateVehicule = $bdd->prepare('UPDATE vehiculeOccas SET auto_model = ?, auto_years = ?, auto_km =?, auto_price = ?, auto_description= ? WHERE id_auto = ?');
            $updateVehicule->execute(array($saisi_model, $saisi_years, $saisi_km, $saisi_price, $saisi_desc, $getid));

            header('Location:afficherVehicule.php');
        }
    } else {
        echo "Aucun véhicule trouvé";
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
    <link rel="stylesheet" href="./RedactionArticle.css">
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
            <h2>Ajouter un véhicule d'occasion</h2>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="auto_model">
                <label for="auto_modelContainer"> Modèle et marque de la voiture : </label>
                <input type="text" id="auto_model" name="auto_model" value="<?= $model; ?>" required>
                <span></span>
            </div>

            <div class="auto_yearsContainer">
                <label for="auto_years"> Année de mise en circulation : </label>
                <input type="text" id="auto_years" name="auto_years" value="<?= $years; ?>" required>
                <span></span>
            </div>


            <div class="auto_kmContainer">
                <label for="auto_km">Kilométrage de la voiture : </label>
                <input type="text" id="auto_km" name="auto_km" value="<?= $km; ?>" required>

            </div>

            <div class="auto_priceContainer">
                <label for="auto_price"> Prix du véhicule : </label>
                <input type="text" id="auto_price" name="auto_price" value="<?= $price; ?>" required>

            </div>


            <div class="auto_descriptionContainer">
                <label for="auto_description">Description du Véhicule</label>
                <textarea name="auto_description" id="auto_description" required>
                    <?= $desc; ?>
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