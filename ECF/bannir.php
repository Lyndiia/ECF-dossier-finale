<?php
session_start();
include("bdd.php");

if (isset($_GET['id']) and !empty($_GET['id'])) {
    $getid = $_GET['id'];
    $recupUser = $bdd->prepare('SELECT * FROM membre WHERE id_user = ?');
    $recupUser->execute(array($getid));
    if ($recupUser->rowCount() > 0) {
        $supprimerUser =  $bdd->prepare('DELETE FROM membre WHERE id_user = ?');
        $supprimerUser->execute(array($getid));

        header('Location:employe.php');
    } else {
        echo "Aucun employé n'a été trouvé";
    }
} else {
    echo "L'identifiant n'a pas été recupéré";
}


if (!$_SESSION['mdp']) {
    header('Location:connexion.php');
}
