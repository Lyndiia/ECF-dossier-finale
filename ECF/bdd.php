<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "fv_database";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    //Définir le mode erreur PDO en exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "connexion echouée : " . $e->getMessage();
}
