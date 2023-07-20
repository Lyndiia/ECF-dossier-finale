<?php


// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "fv_database";

// try {
//     $bdd = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
//     //Définir le mode erreur PDO en exception
//     $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo "connexion echouée : " . $e->getMessage();
// }

$conn = new mysqli('localhost', 'root', '', 'fv_database');
if ($conn->connect_error) {
    die('Error :');
}

// if (isset($_POST["action"])) {
//     $articles = $bdd->query("SELECT * FROM vehiculeOccas");

//     $minPrice = $_POST['min_price'] ?? 0;
//     $maxPrice = $_POST['max_price'] ?? 0;


//     $minKm = $_POST['min_km'] ?? 0;
//     $maxKm = $_POST['max_km'] ?? 0;


//     $minYears = $_POST['min_years'] ?? 0;
//     $maxYears = $_POST['max_years'] ?? 0;



//     if (isset($_POST['min_price'], $_POST['max_price'], $_POST['min_km'], $_POST['max_km'], $_POST['min_years'], $_POST['max_years']) && !empty($_POST['min_price']) && !empty($_POST['max_price']) && !empty($_POST['min_km'])  && !empty($_POST['max_km']) && !empty($_POST['min_years'])  && !empty($_POST['max_years'])) {
//         $articles =  $bdd->query("SELECT * FROM vehiculeOccas WHERE 
//         auto_years BETWEEN '" . $_POST["min_years"] . "' AND '" . $_POST["max_years"] . "'
//         auto_km BETWEEN '" . $_POST["min_km"] . "' AND '" . $_POST["max_km"] . "'
//         auto_price BETWEEN '" . $_POST["min_price"] . "' AND '" . $_POST["max_price"] . "'");
//     }
//     $total_row = mysqli_num_rows($articles);

//     $output = '';


//     if ($total_row > 0) {

//         while ($row = $articles->fetch_object()) {
//             $pic = $row->auto_pic;
//             $model = $row->auto_model;
//             $years = $row->auto_years;
//             $km = $row->auto_km;
//             $price = $row->auto_price;
//             $id = $row->id_auto;
//             $output = '<li>
//             <h3>Modèle de la voiture : </h3>' . $model . '
//             <div class="autoArticle">
//             <br> <img src="./upload/' . $pic . '" alt="Image du vehicule" width="250">
//             <br>
//             <h3>Année de mise en circulation : </h3> ' . $years . '
//             <br>
//             <h3>Kilométrage : </h3>' . $km . 'km
//             <br>
//             <h3>Prix : </h3> ' . $price . '€ <br>
//             <a class="btn" href="autoInfo.php?id=' . $id . '">  En savoir plus : </a>

//         </div>
//         </li>';
//         }
//     } else {
//         echo '<h3>No Data Found</h3>';
//     }

//     echo $output;
// }
if (isset($_POST["action"])) {
    $query = $conn->query("SELECT * FROM vehiculeOccas");
    if (isset($_POST["minimum_price"], $_POST["maximum_price"], $_POST["minimum_km"], $_POST["maximum_km"], $_POST["minimum_years"], $_POST["maximum_years"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]) && !empty($_POST["minimum_km"]) && !empty($_POST["maximum_km"]) && !empty($_POST["minimum_years"]) && !empty($_POST["maximum_years"])) {
        $query = $conn->query("SELECT * FROM vehiculeOccas 
        WHERE `auto_price` BETWEEN '" . $_POST["minimum_price"] . "' AND '" . $_POST["maximum_price"] . "' 
        AND `auto_km` BETWEEN '" . $_POST["minimum_km"] . "' AND '" . $_POST["maximum_km"] . "' 
        AND `auto_years` BETWEEN '" . $_POST["minimum_years"] . "' AND '" . $_POST["maximum_years"] . "'");
    }
    $total_row = mysqli_num_rows($query);
    $output = '';
    if ($total_row > 0) {
        while ($row = $query->fetch_object()) {
            $model = $row->auto_model;
            $pic = $row->auto_pic;
            $years = $row->auto_years;
            $km = $row->auto_km;
            $price = $row->auto_price;
            $idAuto = $row->id_auto;
            $output .= '
            <div class="autoArticle">
            <h3>Modèle de la voiture : </h3>' . $model . '
             <br> <img src="./upload/' . $pic . '" alt="Image du vehicule" width="250">
             <br>
             <h3>Année de mise en circulation : </h3> ' . $years . '
            <br>
            <h3>Kilométrage : </h3>' . $km . 'km            <br>
            <h3>Prix : </h3> ' . $price . '€ <br>
            <a class="btn" href="autoInfo.php?id=' . $idAuto . '">  En savoir plus : </a>

         </div>';
        }
    } else {
        $output = '<h3>No Data Found</h3>';
    }
    echo $output;
}
