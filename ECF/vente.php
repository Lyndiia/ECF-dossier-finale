<?php

include("bdd.php");

$articlesParPage = 12;
$articlesTotalsReq = $bdd->query("SELECT id_auto FROM vehiculeOccas");
$articlesTotals = $articlesTotalsReq->rowCount();
$pagesTotales = ceil($articlesTotals / $articlesParPage);

if (isset($_GET['page']) and !empty($_GET['page']) and $_GET['page'] > 0 and $_GET['page'] <= $pagesTotales) {
    $_GET['page'] = intval($_GET['page']);
    $pageCourante = $_GET['page'];
} else {
    $pageCourante = 1;
}

$depart = ($pageCourante - 1) * $articlesParPage;

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
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Garage V.Parrot - Véhicule d'occassion</title>
    <link rel="stylesheet" href="./style.css">
    <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="./vente.css">
</head>
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

<body>
    <div class="container">
        <div class="row">
            <br />
            <div class="presentation">
                <h2>Véhicules d'occasion - Garage V.Parrot</h2>
                <p> Trouvez votre voiture d'occasion parmi notre stock de véhicules disponibles, garantis et révisés.</p>
            </div>
            <br />
            <div class="article">
                <div class="list-groupe">
                    <h3>Prix : </h3>
                    <input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="30000" />
                    <p id="price_show">10 - 30000</p>
                    <div id="price_range"></div>
                </div>
                <div class="list-groupe">
                    <h3>Kilomètrage : </h3>
                    <input type="hidden" id="hidden_minimum_km" value="0" />
                    <input type="hidden" id="hidden_maximum_km" value="200000" />
                    <p id="km_show">10 - 200000</p>
                    <div id="km_range"></div>
                </div>
                <div class="list-groupe">
                    <h3>Année : </h3>
                    <input type="hidden" id="hidden_minimum_years" value="1990" />
                    <input type="hidden" id="hidden_maximum_years" value="2023" />
                    <p id="years_show">1990 - 2023</p>
                    <div id="years_range"></div>
                </div>
            </div>
            <div class="col-md-9">
                <br />
                <div class="filter_data">
                </div>
            </div>
        </div>
    </div>
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

                <h3>Nous retrouver : </h3>

                <div class="adress">
                    <h4>Garage V.Parrot</h4>
                    <p><?= $adress; ?></p>

                </div>
                <div class="number">
                    <h3>Téléphone :</h3>
                    <p><?= $telephone ?></p>
                </div>


            </div>
        </div>

        <div class="copyright">
            <img src="./assets/img/logogarage.png" alt="Logo du garage">
            <p>Copyright Valentine Arnoux</p>

        </div>

    </footer>


    <script>
        $(document).ready(function() {
            filter_data();

            function filter_data() {
                $('.filter_data').html('<div id="loading" style="" ></div>');
                var action = 'fetch_data';
                var minimum_price = $('#hidden_minimum_price').val();
                var maximum_price = $('#hidden_maximum_price').val();
                var minimum_km = $('#hidden_minimum_km').val();
                var maximum_km = $('#hidden_maximum_km').val();
                var minimum_years = $('#hidden_minimum_years').val();
                var maximum_years = $('#hidden_maximum_years').val();

                $.ajax({
                    url: "fetch_data.php",
                    method: "POST",
                    data: {
                        action: action,
                        minimum_price: minimum_price,
                        maximum_price: maximum_price,
                        minimum_km: minimum_km,
                        maximum_km: maximum_km,
                        minimum_years: minimum_years,
                        maximum_years: maximum_years
                    },
                    success: function(data) {
                        $('.filter_data').html(data);
                    }
                });


            }
            $('#price_range').slider({
                range: true,
                min: 50,
                max: 30000,
                values: [50, 30000],
                step: 50,
                stop: function(event, ui) {
                    $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                    $('#hidden_minimum_price').val(ui.values[0]);
                    $('#hidden_maximum_price').val(ui.values[1]);
                    filter_data();
                }
            });
            $('#km_range').slider({
                range: true,
                min: 50,
                max: 200000,
                values: [50, 200000],
                step: 1000,
                stop: function(event, ui) {
                    $('#km_show').html(ui.values[0] + ' - ' + ui.values[1]);
                    $('#hidden_minimum_km').val(ui.values[0]);
                    $('#hidden_maximum_km').val(ui.values[1]);
                    filter_data();
                }
            });
            $('#years_range').slider({
                range: true,
                min: 1990,
                max: 2023,
                values: [1990, 2023],
                step: 1,
                stop: function(event, ui) {
                    $('#years_show').html(ui.values[0] + ' - ' + ui.values[1]);
                    $('#hidden_minimum_years').val(ui.values[0]);
                    $('#hidden_maximum_years').val(ui.values[1]);
                    filter_data();
                }
            });

        });
    </script>
</body>

</html>