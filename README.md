
# GarageVParrot

Application web pour un garage automobile .

* Envoie formulaire demande de renseignement par visiteur
* Envoir avis qui sera validé par un employé avant d'être publier  
* Page présentant des véhicules à vendre. Modififer article ou supprimer. 
* Filtrage par fourchette de prix, kilometrage et année 
* Connexion admin et employes au même endroit. 
* Possiblité pour l'admin de creer un nouveau membre. 



## Prérequis

Front : Ajax 
        jQuery UI
        Javascript

Back: PHP 8.2.1 sous PDO ( de-commenter extension= php_pdo_msqli.dll  et extension= php_pdo.dll)
      MySQL
      Apache
      PowerShell 
              
## Installer localement

Clonner le projet

```bash
  git clone https://github.com/Lyndiia/ECF-dossier-finale.git
```

Installer les dépendance

```bash
  npm install
```

Demarrer le serveur

```bash
  npm run start
```


## Authors

- [@Lyndiia](https://www.github.com/Lyndiia)


## Donnée connexion administrateur : garagevparrot@gmail.com

Mot de passage : admin1234

CREATION ADMINISTRATEUR AVEC : // if (isset($_POST['valider'])) { // if (!empty($_POST['email']) and !empty($_POST['mdp'])) { // $emaildefaut = " garagevparrot@gmail.com " ; // $mdpdefaut = "admin1234" ;

// $email_saisi = htmlspecialchars($_POST['email']); // $mdp_saisi = htmlspecialchars($_POST['mdp']);

// if ($email_saisi == $emaildefaut and $mdp_saisi == $mdpdefaut) { // $_SESSION['mdp'] = $mdp_saisi; // header('Emplacement : accueilAdmin.php'); // } // } else // echo 'Champs erronés '; // }

## LIENS
* 
