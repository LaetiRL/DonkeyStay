<?php
$titleWeb = 'Modifier un livre';
require_once 'header.php';

$lodgingId = $_GET['id'];

$queryLodging = $dbh->prepare("SELECT room.*, image.img FROM room INNER JOIN image ON room.id = image.room_id WHERE room.id =:lodgingId");

$queryLodging->bindValue(":lodgingId", $lodgingId, PDO::PARAM_STR);

$queryLodging->execute();

$lodgings = $queryLodging->fetchAll(PDO::FETCH_OBJ);

foreach ($lodgings as $lodging) :
    $lodgingRoomtype = $lodging->roomtype_id;
    $lodgingRoomtype = $lodging->hometype_id;
    $lodgingTitle = $lodging->title;
    $lodgingCapacity = $lodging->capacity_id;
    $lodgingBedroom = $lodging->nb_bedroom;
    $lodgingBathroom = $lodging->nb_bathroom;
    $lodgingDescription = $lodging->description;
    $lodgingTv = $lodging->has_tv;
    $lodgingWifi = $lodging->has_wifi;
    $lodgingKitchen = $lodging->has_kitchen;
    $lodgingAircon = $lodging->has_aircon;
    $lodgingAdress = $lodging->adress;
    $lodgingCity = $lodging->city;
    $lodgingStartDispo = $lodging->start_dispo;
    $lodgingEndDispo = $lodging->end_dispo;
    $lodgingPrice = $lodging->price;
    $lodgingImg = $lodging->img; 
endforeach;

if (isset($_POST['modify'])) {
    $homeTypeId = $_POST['home_type'];
    $roomTypeId = $_POST['room_type'];
    $userId = $_SESSION['user_id'];
    $title = $_POST['title'];
    $img = $_POST['img'];
    $nb_bathroom = $_POST['nb_bathroom'];
    $adress = $_POST['adress'];
    $city = $_POST['city'];
    $start_dispo = $_POST['start_dispo'];
    $end_dispo = $_POST['end_dispo'];
    if (is_numeric($_POST['capacity'])) {
        $capacity_id = $_POST['capacity'];
    } else {
        $nb_capacityErr = " * veuillez n'entrer que des chiffres";
    }
    if (is_numeric($_POST['nb_bedroom'])) {
        $nb_bedroom = $_POST['nb_bedroom'];
    } else {
        $nb_bedroomErr = " * veuillez n'entrer que des chiffres";
    }
    if (is_numeric($_POST['nb_bedroom'])) {
        $nb_bedroom = $_POST['nb_bedroom'];
    } else {
        $nb_bedroomErr = " * veuillez n'entrer que des chiffres";
    }
}

?>

<section>
    <h1>Modifier un logement</h1>
    <hr>
    <form method="POST" class="d-flex">
        <div class="div-addform">
            <div class="row">
                <div class="col">
                    <label for="title">Titre</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $lodgingTitle ?>">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="img">Images</label>
                    <input type="text" class="form-control" id="img" name="img" value="<?php echo $lodgingImg ?>">
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
                    <input type="text" class="form-control" id="capacity" name="capacity" value="<?php echo $lodgingCapacity ?>">
                </div>
                <div class="col">
                    <label for="nb_bedroom">nb de Chambres</label>
                    <input type="text" class="form-control" id="nb_bedroom" name="nb_bedroom" value="<?php echo $lodgingBedroom ?>">
                </div>
                <div class="col">
                    <label for="nb_bathroom">nb de Salles de bain</label>
                    <input type="text" class="form-control" id="nb_bathroom" name="nb_bathroom" value="<?php echo $lodgingBathroom ?>">
                </div>
            </div>
            <div class="row">
                <div class="col form-check">
                    <input class="form-check-input" type="checkbox" id="has_tv" name="has_tv" <?php if($lodgingTv == 1) {?> checked <?php }?>>
                    <label class="form-check-label" for="has_tv"> TV </label>
                </div>
                <div class="col form-check">
                    <input class="form-check-input" type="checkbox" id="has_wifi" name="has_wifi" <?php if($lodgingWifi == 1) {?> checked <?php }?>>
                    <label class="form-check-label" for="has_wifi"> Wifi </label>
                </div>
                <div class="col form-check">
                    <input class="form-check-input" type="checkbox" id="has_kitchen" name="has_kitchen" <?php if($lodgingKitchen == 1) {?> checked <?php }?>>
                    <label class="form-check-label" for="has_kitchen">Cuisine</label>
                </div>
                <div class="col form-check">
                    <input class="form-check-input" type="checkbox" id="has_aircon" name="has_aircon" <?php if($lodgingAircon == 1) {?> checked <?php }?>>
                    <label class="form-check-label" for="has_aircon">Climatisation</label>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?php echo $lodgingDescription ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <label for="adress">Adresse</label>
                    <input type="text" class="form-control" id="adress" name="adress" value="<?php echo $lodgingAdress ?>">
                </div>
                <div class="col-sm-4">
                    <label for="city">Ville</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?php echo $lodgingCity ?>">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="start_dispo">Première disponibilité</label><br>
                    <input type="date" id="start_dispo" name="start_dispo" value="<?php echo $lodgingStartDispo ?>">
                </div>
                <div class="col">
                    <label for="end_dispo">Dernière disponibilité</label><br>
                    <input type="date" id="end_dispo" name="end_dispo" value="<?php echo $lodgingEndDispo ?>">
                </div>
                <div class="col">
                    <label for="price">Prix/nuit</label>
                    <input type="text" class="form-control" id="price" name="price" value="<?php echo $lodgingPrice ?>">
                </div>
            </div>
            <button type="submit" name="modify">Modifier</button>
        </div>
    </form>

    <style>
        body {
            background-color: lightgrey;
        }
    </style>
</section>


<?php
require_once 'footer.php';
?>