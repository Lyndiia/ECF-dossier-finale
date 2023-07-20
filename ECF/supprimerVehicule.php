<?php

session_start();
if (!$_SESSION['mdp']) {
    header('Location:index.php');
}


include("bdd.php");


if (isset($_GET['id']) and !empty($_GET['id'])) {
    $getid = $_GET['id'];
    $recupVehicule = $bdd->prepare('SELECT * FROM vehiculeOccas WHERE id_auto=?');
    $recupVehicule->execute(array($getid));

    if ($recupVehicule->rowCount() > 0) {
        $deleteVehicule = $bdd->prepare('DELETE FROM vehiculeOccas WHERE id_auto=?');
        $deleteVehicule->execute(array($getid));
        header('Location:afficherVehicule.php');
    } else {
        echo "Aucun véhicule trouvé";
    }
} else {
    echo "Aucun identifiant trouvé";
}
