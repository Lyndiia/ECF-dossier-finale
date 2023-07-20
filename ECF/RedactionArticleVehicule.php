<?php

session_start();
if (!$_SESSION['mdp']) {
    header('Location:index.php');
}


include("bdd.php");


if (isset($_POST['auto_model'], $_POST['auto_years'], $_POST['auto_km'], $_POST['auto_price'], $_FILES['auto_pic'], $_POST['auto_description'])) {
    if (!empty($_POST['auto_model']) and !empty($_POST['auto_years']) and !empty($_POST['auto_km']) and !empty($_POST['auto_price']) and !empty($_FILES['auto_pic']['tmp_name']) and !empty($_POST['auto_description'])) {



        $auto_model = htmlspecialchars($_POST['auto_model']);
        $auto_years = htmlspecialchars($_POST['auto_years']);
        $auto_km = htmlspecialchars($_POST['auto_km']);
        $auto_price = htmlspecialchars($_POST['auto_price']);
        $auto_pic = $_FILES['auto_pic'];
        $auto_description = nl2br(htmlspecialchars($_POST['auto_description']));

        $targetDir = "./upload/";
        $targetFile = $targetDir . basename($auto_pic['name']);
        $uploadOk = 1;
        $file_name = $_FILES['auto_pic']['name'];
        $tmp_name = $_FILES['auto_pic']['tmp_name'];
        $PicFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $newNamePic = $file_name . $auto_model;

        $check = getimagesize($tmp_name);
        if ($check === false) {
            echo "Le fichier n'est pas une image.";
            $uploadOk = 0;
        }


        if ($auto_pic["size"] > 5000000) {
            echo "Désolé, votre fichier est trop volumineux.";
            $uploadOk = 0;
        }


        $allowedFormats = array("jpg", "jpeg", "png");
        if (!in_array($PicFileType, $allowedFormats)) {
            echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
            $uploadOk = 0;
        }


        if ($uploadOk == 0) {
            echo "Désolé, votre fichier n'a pas été téléchargé.";
        } else {

            if (move_uploaded_file($tmp_name, $targetDir . $newNamePic)) {

                $ins = $bdd->prepare("INSERT INTO vehiculeOccas ( `auto_model`, `auto_years`, `auto_km`, `auto_price`, `auto_pic`, `auto_description`) 
                VALUES(?, ?, ?, ?, ?, ?) ");

                $ins->execute(array($auto_model, $auto_years, $auto_km, $auto_price, $newNamePic, $auto_description));

                $message = "Votre article à bien été posté !";
            } else {
                $message = "Veuillez remplir tous les champs!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article vehicule d'occasion</title>
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
                <input type="text" id="auto_model" name="auto_model" required>
                <span></span>
            </div>

            <div class="auto_yearsContainer">
                <label for="auto_years"> Année de mise en circulation : </label>
                <input type="text" id="auto_years" name="auto_years" required>
                <span></span>
            </div>


            <div class="auto_kmContainer">
                <label for="auto_km">Kilométrage de la voiture : </label>
                <input type="text" id="auto_km" name="auto_km" required>

            </div>

            <div class="auto_priceContainer">
                <label for="auto_price"> Prix du véhicule : </label>
                <input type="text" id="auto_price" name="auto_price" required>

            </div>

            <div class="auto_picContainer">
                <label for="auto_pic">Photo du véhicule : </label>
                <input type="file" id="auto_pic" name="auto_pic" requierd>

            </div>

            <div class="auto_descriptionContainer">
                <label for="auto_description">Description du Véhicule</label>
                <textarea name="auto_description" id="auto_description" required></textarea>
            </div>


            <input class="btn" type="submit" value="Valider">

        </form>
        <br>
        <?php if (isset($message)) {
            echo $message;
        } ?>
    </main>
</body>

</html>
<!-- CREATE TABLE IF NOT EXISTS `vehiculeOccas`
(
  `id_auto` SMALLINT(6) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `auto_model` VARCHAR(100),
  `auto_years` VARCHAR(80),
  `auto_km` VARCHAR(80),
  `auto_descrpition` VARCHAR(500),
  `auto_price` VARCHAR(50)
); 
Motorisation :
Puissance réelle : 265 CH
Puissance fiscale : 17 CV
Consommation : 8.2 l/100km*
Émission de CO2 (NEDC) : 190 g/km*

Carrosserie :
Type de carrosserie : Coupé
Nombre de portes: 3 portes
Nombre de places : 5 places
Largeur : 1804 mm*
Longueur : 4299 mm*

Equipements de série + Options : 
Carte de démarrage Renault "Mains libres"
Châssis Cup
Jantes alliage 19" Trophy
Pack Design R.S. Rouge
Peinture spéciale Jaune Sirius
R.S. Monitor

Motorisation :
Puissance réelle : 110 CH
Puissance fiscale : 6CV
Consommation : 3.9 l/100km*
Émission de CO2 (NEDC) : 118 g/km*

Carrosserie :
Type de carrosserie : Coupé
Nombre de portes: 5 portes
Nombre de places : 5 places
Largeur : 1811 mm*
Longueur : 4695 mm*

Equipements de série + Options :
Aide parking
Frein de parking automatique
Radar de recul
Rétroviseurs rabattables
Climatisation automatique
GPS
Régulateur de vitesse
Régulateur limiteur de vitesse
Vitres électriques
Bluetooth
Feux automatiques
Roue de secours
Système Start & Stop
essuis vitres automatiques

CREATE TABLE IF NOT EXISTS `membre`
(
  `id_user` SMALLINT(6) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_email` TEXT(10),
  `usermdp` VARCHAR(80),
); 

INSERT INTO membre ( `user_email`, `user_mdp`, `user_name`) 
                VALUES('employe@gmail.com', 'employe1234', 'Lucas Arnold');


CREATE TABLE IF NOT EXISTS `articles`
(
  `id_user` SMALLINT(6) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `aPropos` TEXT(10),
  `entretien` TEXT(10),
  `carrosserie` TEXT(10),
  `mecanique` TEXT(10),
  `adress` VARCHAR(500),
  `telephone` VARCHAR(50)
); 
 CREATE TABLE IF NOT EXISTS `contactMess`
(
  `id_message` SMALLINT(6) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `message_name` VARCHAR(100),
  `message_phone` SMALLINT(10),
  `message_email` VARCHAR(100),
  `message_sujet` VARCHAR(80),
  `message_commentaire` VARCHAR(500)
);