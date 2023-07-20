<?php

session_start();
if (!$_SESSION['mdp']) {
    header('Location:index.php');
}


include("bdd.php");

if (isset($_GET['id']) and !empty($_GET['id'])) {
    $getid = $_GET['id'];
    $recupVehicule = $bdd->prepare('SELECT * FROM contactMess WHERE id_message=?');
    $recupVehicule->execute(array($getid));

    if ($recupVehicule->rowCount() > 0) {
        $deleteVehicule = $bdd->prepare('DELETE FROM contactMess WHERE id_message=?');
        $deleteVehicule->execute(array($getid));
        header('Location:contactMessage.php');
    } else {
        echo "Aucune demande trouvée";
    }
} else {
    echo "Aucun identifiant trouvé";
}
