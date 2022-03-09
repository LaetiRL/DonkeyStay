<?php
$titleWeb = "Ajouter un logement";
require_once "header.php";

if (isset($_POST['validate'])) {
    if (!empty($_POST['title'])) {
        $title = $_POST['title'];
    } else {
        $titleErr = "* veuillez ajouter un titre";
    }
    if (!empty($_POST['img'])) {
        $img = $_POST['img'];
    } else {
        $imgErr = "* veuillez ajouter une image";
    }
    if (!empty($_POST['capacity'])) {
        $capacity = $_POST['capacity'];
    } else {
        $capacityErr = "* veuillez ajouter la capacité maximale";
    }
    if (!empty($_POST['nb_bedroom']) && is_numeric($_POST['nb_bedroom'])) {
        $nb_bedroom = $_POST['nb_bedroom'];
    } elseif (empty($_POST['nb_bedroom'])) {
        $nb_bedroomErr = "* veuillez indiquer le nombre de chambre";
    } elseif (is_numeric($_POST['nb_bedroom']) == false) {
        $nb_bedroomErr = "* veuillez n'entrer que des chiffres";
    }
    if (!empty($_POST['nb_bathroom']) && is_numeric($_POST['nb_bathroom'])) {
        $nb_bathroom = $_POST['nb_bathroom'];
    } elseif (empty($_POST['nb_bathroom'])) {
        $nb_bathroomErr = "* veuillez indiquer le nombre de salle de bain";
    } elseif (is_numeric($_POST['nb_bathroom']) == false) {
        $nb_bathroomErr = "* veuillez n'entrer que des chiffres";
    }
    if (!empty($_POST['has_tv'])) {
        $has_tv = 1;
    } else {
        $has_tv = 0;
    }
    if (!empty($_POST['has_wifi'])) {
        $has_wifi = 1;
    } else {
        $has_wifi = 0;
    }
    if (!empty($_POST['has_kitchen'])) {
        $has_kitchen = 1;
    } else {
        $has_kitchen = 0;
    }
    if (!empty($_POST['has_aircon'])) {
        $has_aircon = 1;
    } else {
        $has_aircon = 0;
    }
    if (!empty($_POST['description'])) {
        $description = $_POST['description'];
    } else {
        $descriptionErr = "* veuillez ajouter une description";
    }
    if (!empty($_POST['adress'])) {
        $adress = $_POST['adress'];
    } else {
        $adressErr = "* veuillez ajouter une adresse";
    }
    if (!empty($_POST['city'])) {
        $city = $_POST['city'];
    } else {
        $cityErr = "* veuillez ajouter une ville";
    }
    if (!empty($_POST['start_dispo'])) {
        $start_dispo = $_POST['start_dispo'];
    } else {
        $start_dispoErr = "* veuillez indiquer la première disponibilité";
    }
    if (!empty($_POST['end_dispo'])) {
        $end_dispo = $_POST['end_dispo'];
    } else {
        $end_dispoErr = "* veuillez indiquer la dernière disponibilité";
    }
    if (!empty($_POST['price']) && is_numeric($_POST['price'])) {
        $prix = $_POST['price'];
    } elseif (empty($_POST['price'])) {
        $priceErr = "* veuillez entrer un prix";
    } elseif (is_numeric($_POST['price']) == false) {
        $priceErr = "* veuillez n'entrer que des chiffres";
    }

    if (
        !isset($titleErr) && !isset($imgErr) && !isset($capacityErr)
        && !isset($nb_bedroomErr) && !isset($nb_bathroomErr) && !isset($descriptionErr)
        && !isset($adressErr) && !isset($cityErr) && !isset($start_dispoErr)
        && !isset($end_dispoErr) && !isset($priceErr)
    ) {

        $queryInsert = $dbh->prepare("INSERT INTO room (`title`, `capacity_id` ,`nb_bedroom`, `nb_bathroom`, `description`,`has_tv`, `has_wifi`, `has_kitchen`, `has_aircon`, `adress`, `city`, `start_dispo`, `end_dispo`, `price`) VALUES (:title, 2, :nb_bedroom, :nb_bathroom, :description, :has_tv, :has_wifi, :has_kitchen, :has_aircon, :adress, :city, :start_dispo, :end_dispo, :price)");

        $queryInsert->bindValue(":title", $title, PDO::PARAM_STR);
        $queryInsert->bindValue(":capacity", $capacity, PDO::PARAM_INT);
        $queryInsert->bindValue(":nb_bedroom", $nb_bedroom, PDO::PARAM_INT);
        $queryInsert->bindValue(":nb_bathroom", $nb_bathroom, PDO::PARAM_INT);
        $queryInsert->bindValue(":description", $description, PDO::PARAM_STR);
        $queryInsert->bindValue(":has_tv", $has_tv, PDO::PARAM_INT);
        $queryInsert->bindValue(":has_wifi", $has_wifi, PDO::PARAM_INT);
        $queryInsert->bindValue(":has_kitchen", $has_kitchen, PDO::PARAM_INT);
        $queryInsert->bindValue(":has_aircon", $has_aircon, PDO::PARAM_INT);
        $queryInsert->bindValue(":adress", $adress, PDO::PARAM_STR);
        $queryInsert->bindValue(":city", $city, PDO::PARAM_STR);
        $queryInsert->bindValue(":start_dispo", $start_dispo, PDO::PARAM_STR);
        $queryInsert->bindValue(":end_dispo", $end_dispo, PDO::PARAM_STR);
        $queryInsert->bindValue(":price", $price, PDO::PARAM_STR);

        $queryInsert->execute();

        $user_id = $dbh->lastInsertId();

        $queryInsertImg = $dbh->prepare("INSERT INTO image (img, user_id) VALUES (:img, $user_id)");

        $queryInsertImg->bindValue(":img", $img, PDO::PARAM_STR);

        $queryInsertImg->execute();

        //header('location: index.php');
    }
}
?>

<section>
    <h1>Ajouter un logement</h1>
    <hr>
    <form method="POST" action="form_addLodging.php" class="d-flex">
        <div class="div-addform">
            <div class="row">
                <div class="col">
                    <label for="title">Titre</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="img">Images</label>
                    <input type="text" class="form-control" id="img" name="img">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="home_type">Logement</label>
                    <select class="form-control" id="home_type" name="home_type">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                </div>
                <div class="col">
                    <label for="room_type">Type de logement</label>
                    <select class="form-control" id="room_type" name="room_type">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="capacity">Capacité</label>
                    <input type="text" class="form-control" id="capacity" name="capacity">
                </div>
                <div class="col">
                    <label for="nb_bedroom">nb de Chambres</label>
                    <input type="text" class="form-control" id="nb_bedroom" name="nb_bedroom">
                </div>
                <div class="col">
                    <label for="nb_bathroom">nb de Salles de bain</label>
                    <input type="text" class="form-control" id="nb_bathroom" name="nb_bathroom">
                </div>
            </div>
            <div class="row">
                <div class="col form-check">
                    <input class="form-check-input" type="checkbox" id="has_tv" name="has_tv">
                    <label class="form-check-label" for="has_tv"> TV </label>
                </div>
                <div class="col form-check">
                    <input class="form-check-input" type="checkbox" id="has_wifi" name="has_wifi">
                    <label class="form-check-label" for="has_wifi"> Wifi </label>
                </div>
                <div class="col form-check">
                    <input class="form-check-input" type="checkbox" id="has_kitchen" name="has_kitchen">
                    <label class="form-check-label" for="has_kitchen">Cuisine</label>
                </div>
                <div class="col form-check">
                    <input class="form-check-input" type="checkbox" id="has_aircon" name="has_aircon">
                    <label class="form-check-label" for="has_aircon">Climatisation</label>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="3"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <label for="adress">Adresse</label>
                    <input type="text" class="form-control" id="adress" name="adress">
                </div>
                <div class="col-sm-4">
                    <label for="city">Ville</label>
                    <input type="text" class="form-control" id="city" name="city">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="start_dispo">Première disponibilité</label><br>
                    <input type="date" id="start_dispo" name="start_dispo">
                </div>
                <div class="col">
                    <label for="end_dispo">Dernière disponibilité</label><br>
                    <input type="date" id="end_dispo" name="end_dispo">
                </div>
                <div class="col">
                    <label for="price">Prix/nuit</label>
                    <input type="text" class="form-control" id="price" name="price">
                </div>
            </div>
            <button type="submit" name="validate">+ Ajouter</button>
        </div>
    </form>

    <style>
        body {
            background-color: lightgrey;
        }
    </style>