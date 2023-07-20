<?php

include("bdd.php");

if (isset($_GET['id']) && !empty($_GET['id'])) {
  $get_id = htmlspecialchars($_GET['id']);

  $articles = $bdd->prepare("SELECT * FROM vehiculeOccas WHERE `id_auto` = ? ");
  $articles->execute(array($get_id));

  if ($articles->rowCount() == 1) {
    $articles = $articles->fetch();
    $model = $articles['auto_model'];
    $years = $articles['auto_years'];
    $kilometres = $articles['auto_km'];
    $price = $articles['auto_price'];
    $autoPic = $articles['auto_pic'];
    $desc = nl2br($articles['auto_description']);
  } else {
    die("Cet article n'existe pas !");
  }
} else {
  die('Erreur');
}

$recupInfos = $bdd->prepare('SELECT * FROM articles ');
$recupInfos->execute(array());
if ($recupInfos->rowCount() > 0) {
  $Infos = $recupInfos->fetch();

  $aPropos =  $Infos['aPropos'];
  $entretien = $Infos['entretien'];
  $carrosserie = $Infos['carrosserie'];
  $mecanique = $Infos['mecanique'];
  $adress = $Infos['adress'];
  $telephone =  $Infos['telephone'];
}

if (isset($_POST['valider'])) {
  if (!empty($_POST['name']) and !empty($_POST['phone']) and !empty($_POST['email']) and !empty($_POST['sujet']) and !empty($_POST['message'])) {
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $sujet = htmlspecialchars($_POST['sujet']);
    $comm = htmlspecialchars($_POST['email']);

    $insertComm = $bdd->prepare('INSERT INTO contactMess (`message_name`, `message_phone`, `message_email`,`message_sujet`,`message_commentaire`) VALUES (?, ?, ?, ?, ?)');
    $insertComm->execute(array($name, $phone, $email, $sujet, $comm));
  } else {
    echo "Veuillez remplir tous les champs!";
  }
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>

  <title><?= $model ?></title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="./style.css" rel="stylesheet">
  <link rel="stylesheet" href="./formContact.css">
  <link rel="stylesheet" href="./autoInfo.css">
  <script src="https://kit.fontawesome.com/55f86ab1a5.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript">
  </script>

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

            <li>
              <a href="./index.html#nosServices"> Nos services </a>
            </li>
            <li>
              <a href="./vente.php"> Véhicule d 'occasion</a>
            </li>
            <li>
              <a href="./form.php"> Nous contacter </a>
            </li>
          </ul>
        </div>

        <div class="navRightPart">
          <div class="connect">
            <a href="./connexion.php"> Se connecter </a>

          </div>

        </div>


      </div>

    </nav>
  </header>

  <main>
    <h2>Véhicule d'occasion </h2>
    <div class="vehiculeInfos">
      <h3> Modèle et marque de la voiture : <?= $model; ?></h3>
      <img src="./upload/<?= $autoPic; ?>" alt="Image du vehicule" width="400">
      <div class="infosGenerale">
        <h4>Année de mise en circulation : </h4>
        <p><?= $years; ?></p>
        <h4>Kilométrage : </h4>
        <p><?= $kilometres . 'km' ?></p>
        <h4> Prix du véhicule : </h4>
        <p><?= $price . '€' ?></p>
      </div>

      <div class="vehiculeDesc">
        <h4>Equipements et options : </h4>
        <p><?= $desc; ?></p>
      </div>

    </div>

    <div class="demandeInfos">
      <h2>Demande d'informations sur cette voiture : </h2>
      <p>Par téléphone au <?= $telephone; ?> ou en remplissant le formulaire ci-dessous. </p>
    </div>

    <div class="formContact">
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="name-container">
          <label for="name"> Prénom et Nom</label>
          <input type="text" id="name" name="name" required pattern="^[A-Za-z -]+$">
          <span></span>
        </div>

        <div class="number-container">
          <label for="phone"> Numéro de téléphone</label>
          <input type="text" id="phone" name="phone" required>
          <span></span>
        </div>


        <div class="email-container">
          <label for="email"> Email</label>
          <input type="text" id="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
          <span>Email inncorrect</span>
        </div>

        <div class="object-container">
          <label for="sujet"> Objet de la demande</label>
          <input type="text" id="sujet" name="sujet" value="Informations concernant la voiture <?= $model . " " . $kilometres ?>">

        </div>

        <div class="message">
          <label for="text">Commentaire</label>
          <textarea id="message" name="message" rows="10" cols="50" maxlenght="500" required></textarea>
        </div>


        <input class="btn" name="valider" type="submit" value="Valider">
      </form>
      <div id="res"></div>
    </div>




  </main>

  <footer>
    <div class="enPlus">

      <div class="ouverture">
        <h3> Horaires d 'ouverture</h3>
        <div class="timeList">
          <div class="day">

            <h4> Lundi: </h4>
            <h4> Mardi: </h4>
            <h4> Mercredi: </h4>
            <h4> Jeudi: </h4>
            <h4> Vendredi: </h4>
            <h4> Samedi: </h4>
            <h4> Dimanche: </h4>
          </div>

          <div class="hours">
            <ul id="timesOpen">
              <li> 08: 45 - 12: 00, 14: 00 - 18: 00 </li>
              <li> 08: 45 - 12: 00, 14: 00 - 18: 00 </li>
              <li> 08: 45 - 12: 00, 14: 00 - 18: 00 </li>
              <li> 08: 45 - 12: 00, 14: 00 - 18: 00 </li>
              <li> 08: 45 - 12: 00, 14: 00 - 18: 00 </li>
              <li> 08: 45 - 12: 00 </li>
              <li> Fermé </li>
            </ul>
          </div>

        </div>


      </div>


      <div class="infos">

        <h3> Nous retrouver: </h3>

        <div class="adress">
          <h4> Garage V.Parrot </h4>
          <p> <?= $adress; ?> </p>

        </div>
        <div class="number">
          <h3> Téléphone: </h3>
          <p> <?= $telephone; ?></p>
        </div>


      </div>
    </div>

    <div class="copyright">
      <img src="./assets/img/logogarage.png" alt="Logo du garage">
      <p> Copyright Valentine Arnoux </p>

    </div>

  </footer>

</body>

</html>