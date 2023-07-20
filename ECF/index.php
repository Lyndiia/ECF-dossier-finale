<?php

include("bdd.php");

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
  if (!empty($_POST['avis_name']) and !empty($_POST['avis_note']) and !empty($_POST['avis_comm'])) {
    $name = htmlspecialchars($_POST['avis_name']);
    $note = intval($_POST['avis_note']);
    $comm = htmlspecialchars($_POST['avis_comm']);
    $insertComm = $bdd->prepare('INSERT INTO avis (`avis_name`, `avis_note`, `avis_comm`) VALUES (?, ?, ?)');
    $insertComm->execute(array($name, $note, $comm));
  } else {
    echo "Veuillez remplir tous les champs!";
  }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Garage V.Parrot</title>
  <meta name="description" content="Le garage V.Parrot vous attend avec ou sans rendez-vous pour travaux de mécanique, de carrosserie ou d'entretient. Retrouvez aussi de nombreux véhicules d'occasion à des prix abordable." />
  <link rel="stylesheet" href="./style.css" />
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
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
            <li><a href="#nosServices">Nos services</a></li>
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
    <div class="firstPart">
      <div class="background"></div>

      <div class="APropos">
        <h2>A propos de nous :</h2>

        <p>
          <?= $aPropos; ?>
        </p>
      </div>

      <div class="nosServices" id="nosServices">
        <h2>Nos Services :</h2>
        <div class="Entretien">
          <div class="entretLeft"></div>
          <div class="entretRight">
            <h3>Entretien régulier :</h3>
            <p class="txtEntret">
              <?= $entretien; ?>
            </p>
          </div>
        </div>
        <div class="carrosserie">
          <div class="carrosLeft">
            <h3>Réparation de carrosserie :</h3>
            <p class="txtCarros">
              <?= $carrosserie; ?>
            </p>
          </div>
          <div class="carrosright"></div>
        </div>
        <div class="mecanique">
          <div class="mecaLeft"></div>
          <div class="mecaRight">
            <h3>Réparation mécanique :</h3>
            <p class="txtMeca">
              <?= $mecanique; ?>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="avisClients">
      <h2>Avis clients</h2>
      <div class="avisContainer">
        <div class="commentaires">
          <div class="titleAvis">
            <h3>Nos derniers avis clients :</h3>
          </div>
          <div class="commContainer">
            <?php
            $recupAvis = $bdd->query('SELECT * FROM avisValide ORDER BY id_avis DESC LIMIT 2');
            while ($a = $recupAvis->fetch()) {
            ?>
              <div class="recupAvis">

                <h4>Nom : </h4>
                <p><?= $a['valide_name'] ?></p>
                <h4>Note : </h4>
                <p><?= $a['valide_note'] . "&#9733" ?></p>
                <h4>Commentaire : </h4>
                <p><?= $a['valid_comm'] ?></p>

              </div>
            <?php
            }
            ?>
            <a href="plusDAvis.php">Plus d'avis </a>
          </div>
        </div>

        <div class="formComm">
          <div class="titleComm">
            <h3>Laissez-nous un avis :</h3>
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


      <div id="cleTransition">
        <img src="./assets/img/cle.png" alt="clé à fourche" />
      </div>
  </main>

  <footer>
    <div class="enPlus">
      <div class="ouverture">
        <h3>Horaires d'ouverture</h3>
        <div class="timeList">
          <div class="day">
            <h4>Lundi :</h4>
            <h4>Mardi :</h4>
            <h4>Mercredi :</h4>
            <h4>Jeudi :</h4>
            <h4>Vendredi :</h4>
            <h4>Samedi :</h4>
            <h4>Dimanche :</h4>
          </div>

          <div class="hours">
            <ul id="timesOpen">
              <li>08:45 - 12:00, 14:00 - 18:00</li>
              <li>08:45 - 12:00, 14:00 - 18:00</li>
              <li>08:45 - 12:00, 14:00 - 18:00</li>
              <li>08:45 - 12:00, 14:00 - 18:00</li>
              <li>08:45 - 12:00, 14:00 - 18:00</li>
              <li>08:45 - 12:00</li>
              <li>Fermé</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="infos">
        <h3>Nous retrouver :</h3>

        <div class="adress">
          <h4>Garage V.Parrot</h4>
          <p><?= $adress; ?></p>

        </div>
        <div class="number">
          <h3>Téléphone :</h3>
          <p><?= $telephone; ?></p>
        </div>
      </div>
    </div>

    <div class="copyright">
      <img src="./assets/img/logogarage.png" alt="Logo du garage" />
      <p>Copyright Valentine Arnoux</p>
    </div>
  </footer>


</body>

</html>