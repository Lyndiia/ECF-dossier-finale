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

$articlesParPage = 12;
$articlesTotalsReq = $bdd->query("SELECT id_avis FROM avisValide");
$articlesTotals = $articlesTotalsReq->rowCount();
$pagesTotales = ceil($articlesTotals / $articlesParPage);

if (isset($_GET['page']) and !empty($_GET['page']) and $_GET['page'] > 0 and $_GET['page'] <= $pagesTotales) {
    $_GET['page'] = intval($_GET['page']);
    $pageCourante = $_GET['page'];
} else {
    $pageCourante = 1;
}

$depart = ($pageCourante - 1) * $articlesParPage;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage V.Parrot - Avis clients</title>
    <link rel="stylesheet" href="./style.css" />

</head>

<body>
    <style>
        body {
            background: #26252695;
        }
    </style>

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

        <div class="title">
            <h2>Avis clients</h2>

        </div>

        <?php
        $recupAvis = $bdd->query('SELECT * FROM avisValide');
        while ($a = $recupAvis->fetch()) {
        ?>
            <div class="Recup">
                <div class="flex">
                    <div class="nom">

                        <h3>Nom : </h3>
                        <p><?= $a['valide_name'] ?></p>
                    </div>
                    <div class="note">
                        <h3>Note : </h3>
                        <p><?= $a['valide_note'] . "&#9733"  ?></p>

                    </div>

                </div>
                <h3>Commentaire : </h3>
                <p><?= $a['valid_comm'] ?></p>


            </div>
        <?php
        }
        ?>
        <div class="pagination">
            <h4> Page : </h4>
            <?php
            for ($i = 1; $i <= $pagesTotales; $i++) {
                if ($i == $pageCourante) {
                    echo $i . ' ';
                } else {
                    echo '<a href="index.php?page=' . $i . '">' . $i . '</a>';
                }
            }
            ?>
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