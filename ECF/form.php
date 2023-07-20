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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nous contacter - Garage V.Parrot</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./formContact.css">
    <script src="https://kit.fontawesome.com/55f86ab1a5.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        function sendData() {
            var name = document.getElementById("name").value;
            var phone = document.getElementById("phone").value;
            var email = document.getElementById("email").value;
            var sujet = document.getElementById("sujet").value;
            var message = document.getElementById("message").value;

            $.ajax({
                type: 'post',
                url: 'contact.php',
                data: {
                    name: name,
                    phone: phone,
                    email: email,
                    sujet: sujet,
                    message: message
                },
                success: function(response) {
                    $('#res').html("Votre message à bien été envoyé!");
                }
            });

            return false;
        }
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
        <div class="contactUs">
            <h2>Contactez-nous</h2>
            <p>Merci de remplir le formulaire en indiquant votre demande où par téléphone au <?= $telephone; ?></p>
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
                    <input type="text" id="sujet" name="sujet">

                </div>

                <div class="message">
                    <label for="text">Commentaire</label>
                    <textarea id="message" name="message" rows="10" cols="50" maxlenght="500" required></textarea>
                </div>


                <input class="btn" type="submit" name="valider" value="Valider">
            </form>
            <div id="res"></div>
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


</body>

</html>