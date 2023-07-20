<?php

include("bdd.php");

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
// if (isset($_POST['name'])) {
//   $message_name = $_POST['name'];
//   $message_phone = $_POST['phone'];
//   $message_email = $_POST['email'];
//   $message_sujet = $_POST['sujet'];
//   $message_commentaire = $_POST['message'];

//   $con = mysqli_connect("$servername", "$username", "$password", "$database");

//   $insert = " INSERT INTO contactMess ( `message_name`,`message_phone`, `message_email`, `message_sujet`,`message_commentaire`) VALUES('$message_name','$message_phone','$message_email', '$message_sujet', '$message_commentaire' ) ";

//   mysqli_query($con, $insert);
// };


?>

<!-- CREATE TABLE IF NOT EXISTS `contactMess`
(
  `id_message` SMALLINT(6) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `message_name` VARCHAR(100),
  `message_phone` SMALLINT(10),
  `message_email` VARCHAR(100),
  `message_sujet` VARCHAR(80),
  `message_commentaire` VARCHAR(500)
); -->