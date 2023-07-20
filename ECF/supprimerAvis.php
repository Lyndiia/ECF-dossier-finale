<?php

session_start();
if (!$_SESSION['mdp']) {
    header('Location:index.php');
}

include("bdd.php");

if (isset($_GET['id']) and !empty($_GET['id'])) {
    $getid = $_GET['id'];
    $recupAvis = $bdd->prepare('SELECT * FROM avis WHERE id_avis=?');
    $recupAvis->execute(array($getid));

    if ($recupAvis->rowCount() > 0) {
        $deleteAvis = $bdd->prepare('DELETE FROM avis WHERE id_avis=?');
        $deleteAvis->execute(array($getid));
        header('Location:validationCommentaire.php');
    } else {
        echo "Aucun avis trouvé";
    }
} else {
    echo "Aucun identifiant trouvé";
}
