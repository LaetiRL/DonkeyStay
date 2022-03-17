<?php
$titleWeb = 'Modifier un livre';
require_once 'header.php';

if(!isset($_SESSION['name'])) {
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}

$lodgingId = $_GET['id'];

$queryLodging = $dbh->prepare("SELECT room.*, image.img, image.id FROM room INNER JOIN image ON room.id = image.room_id WHERE room.id =:lodgingId");

$queryLodging->bindValue(":lodgingId", $lodgingId, PDO::PARAM_STR);

$queryLodging->execute();

$lodgings = $queryLodging->fetchAll(PDO::FETCH_OBJ);

foreach ($lodgings as $lodging) :
    $lodgingRoomtype = $lodging->roomtype_id;
    $lodgingHometype = $lodging->hometype_id;
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
   //$lodgingImg = $lodging->img;
endforeach;

if (isset($_POST['modify'])) {
    $homeTypeId = $_POST['home_type'];
    $roomTypeId = $_POST['room_type'];
    $userId = $_SESSION['user_id'];
    $title = $_POST['title'];
    $adress = $_POST['adress'];
    $city = $_POST['city'];
    $description = $_POST['description'];
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
    if (is_numeric($_POST['nb_bathroom'])) {
        $nb_bathroom = $_POST['nb_bathroom'];
    } else {
        $nb_bathroomErr = " * veuillez n'entrer que des chiffres";
    }
    if (is_numeric($_POST['nb_bathroom'])) {
        $price = $_POST['price'];
    } else {
        $priceErr = " * veuillez n'entrer que des chiffres";
    }
    if (!empty($_POST['has_tv'])) {
        $has_tv = 1;
    } else {
        $has_tv = 0;
    }
    if (!empty($_POST['has_wifi'])) {
        $has_wifi = 1;
    } else {
        $has_wifi =0;
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
    
    if (count($_FILES['img']['name']) < 5) {
        $imgErr = " * minimum 5 images";
    } elseif (count($_FILES['img']['name']) > 19)  {
        $imgErr = " * maximum 20 images";
    }

    if (
        !isset($titleErr) && !isset($imgErr) && !isset($capacityErr)
        && !isset($nb_bedroomErr) && !isset($nb_bathroomErr) && !isset($descriptionErr)
        && !isset($adressErr) && !isset($cityErr) && !isset($start_dispoErr)
        && !isset($end_dispoErr) && !isset($priceErr)
    ) {

        $queryUpdate = $dbh->prepare("UPDATE room SET roomtype_id =:roomTypeId, hometype_id =:homeTypeId, title =:title, capacity_id =:capacity_id, nb_bedroom =:nb_bedroom, nb_bathroom =:nb_bathroom, description =:description, has_tv =:has_tv, has_wifi =:has_wifi, has_kitchen =:has_kitchen, has_aircon =:has_aircon, adress =:adress, city =:city, start_dispo =:start_dispo, end_dispo =:end_dispo, price =:price WHERE id =:lodgingId");

        $queryUpdate->bindValue(":roomTypeId", $roomTypeId, PDO::PARAM_INT);
        $queryUpdate->bindValue(":homeTypeId", $homeTypeId, PDO::PARAM_INT);
        $queryUpdate->bindValue(":title", $title, PDO::PARAM_STR);
        $queryUpdate->bindValue(":capacity_id", $capacity_id, PDO::PARAM_INT);
        $queryUpdate->bindValue(":nb_bedroom", $nb_bedroom, PDO::PARAM_INT);
        $queryUpdate->bindValue(":nb_bathroom", $nb_bathroom, PDO::PARAM_INT);
        $queryUpdate->bindValue(":description", $description, PDO::PARAM_STR);
        $queryUpdate->bindValue(":has_tv", $has_tv, PDO::PARAM_STR);
        $queryUpdate->bindValue(":has_wifi", $has_wifi, PDO::PARAM_STR);
        $queryUpdate->bindValue(":has_kitchen", $has_kitchen, PDO::PARAM_STR);
        $queryUpdate->bindValue(":has_aircon", $has_aircon, PDO::PARAM_STR);
        $queryUpdate->bindValue(":adress", $adress, PDO::PARAM_STR);
        $queryUpdate->bindValue(":city", $city, PDO::PARAM_STR);
        $queryUpdate->bindValue(":start_dispo", $start_dispo, PDO::PARAM_STR);
        $queryUpdate->bindValue(":end_dispo", $end_dispo, PDO::PARAM_STR);
        $queryUpdate->bindValue(":price", $price, PDO::PARAM_STR);
        $queryUpdate->bindValue(":lodgingId", $lodgingId, PDO::PARAM_INT);

        $queryUpdate->execute();

       /*  $queryUpdateImg = $dbh->prepare("UPDATE image SET img =:img WHERE room_id =:lodgingId");

        $queryUpdateImg->bindValue(":img", $img, PDO::PARAM_STR);
        $queryUpdateImg->bindValue(":lodgingId", $lodgingId, PDO::PARAM_INT);

        $queryUpdateImg->execute(); */

        $targetDir = "img/logements/"; 
        $allowTypes = array('jpg','png','jpeg');

        $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
        $fileNames = array_filter($_FILES['img']['name']);

        $selectImgQuery = $dbh->query("SELECT * FROM image");
        $selectImg = $selectImgQuery->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($selectImg as $selectImgRow){
            if ($selectImgRow['room_id'] === $lodgingId) {
                $deleteImgQuery = $dbh->query("DELETE FROM image WHERE room_id = $lodgingId");   
            }
        }
    
        if(!empty($fileNames)){ 
            foreach($_FILES['img']['name'] as $key=>$val){ 
                // File upload path 
                $fileName = basename($_FILES['img']['name'][$key]); 
                $targetFilePath = $targetDir . $fileName; 
                
                // Check whether file type is valid 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                    if(move_uploaded_file($_FILES["img"]["tmp_name"][$key], $targetFilePath)){ 
                        // Image db insert sql 
                        $insertValuesSQL .= "('".$targetDir.$fileName."',".$lodgingId."),"; 
                    }else{ 
                        $imgErr = $_FILES['img']['name'][$key].' | '."Erreur lors du téléversement"; 
                    }  
                }else{ 
                    $imgErr = ' '.$_FILES['img']['name'][$key].' | '."Format d'image invalide. Formats attendus: jpg, jpeg, png."; 
                    return $imgErr;
                }   
            } 
            
            if(!empty($insertValuesSQL) && !isset($imgErr)){ 
                $insertValuesSQL = trim($insertValuesSQL, ','); 
                // Insert image file name into database 
                $insert = $dbh->query("INSERT INTO image (img, room_id) VALUES $insertValuesSQL"); 
                if($insert === false){ 
                    $imgErr = "Désolé, l'insertion dans la base de données à échouée"; 
                }
            }
        }
        echo "<script type='text/javascript'>document.location.replace('lodging.php');</script>";
    }
}

?>

<section>
    <h1>Modifier un logement</h1>
    <hr>
    <form method="POST" class="d-flex j-c" enctype="multipart/form-data">
        <div class="div-addform">
            <div class="row">
                <div class="col">
                    <label for="title">Titre</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $lodgingTitle ?>">
                </div>
            </div>
            <div class="row">
                <div class="container-fluid">
                    <div class="col">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="img">Images</label><small class="error" id="imgErr"><?php if(isset($imgErr)) {echo $imgErr;}; if(isset($statusMsg)) {echo $statusMsg;}?></small>
                                    <input type="file" name="img[]" id="img" multiple class="form-control" >
                                </div>
                                <div class="form-group">
                                    <div id="image_preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="_preview.js"></script>
            </div>
            <!-- <label for="img">Images</label>
            <input type="text" class="form-control" id="img" name="img" value="<?php echo $lodgingImg ?>"> -->
            <div class="row">
                <div class="col">
                    <label for="home_type">Logement</label>
                    <select class="form-control" id="home_type" name="home_type">
                    <?php
                            $hometypeQuery = $dbh->query('SELECT * FROM hometype');
                            $hometype= $hometypeQuery->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($hometype as $row_hometype) {
                                echo '<option value="'.$row_hometype['id'].'">'.$row_hometype['hname'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <label for="room_type">Type de logement</label>
                    <select class="form-control" id="room_type" name="room_type">
                    <?php
                            $roomtypeQuery = $dbh->query('SELECT * FROM roomtype');
                            $roomtype= $roomtypeQuery->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($roomtype as $row_roomtype) {
                                echo '<option value="'.$row_roomtype['id'].'">'.$row_roomtype['rname'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="capacity">Capacité</label><small class="error"><?php if (isset($capacityErr)) echo $capacityErr ?></small>
                    <input type="text" class="form-control" id="capacity" name="capacity" value="<?php echo $lodgingCapacity ?>">
                </div>
                <div class="col">
                    <label for="nb_bedroom">nb de Chambres</label><small class="error"><?php if (isset($capacityErr)) echo $capacityErr ?></small>
                    <input type="text" class="form-control" id="nb_bedroom" name="nb_bedroom" value="<?php echo $lodgingBedroom ?>">
                </div>
                <div class="col">
                    <label for="nb_bathroom">nb de Salles de bain</label><small class="error"><?php if (isset($capacityErr)) echo $capacityErr ?></small>
                    <input type="text" class="form-control" id="nb_bathroom" name="nb_bathroom" value="<?php echo $lodgingBathroom ?>">
                </div>
            </div>
            <div class="row">
                <div class="col form-check">
                    <input class="form-check-input" type="checkbox" id="has_tv" name="has_tv" <?php if ($lodgingTv == 1) { ?> checked <?php } ?>>
                    <label class="form-check-label" for="has_tv"> TV </label>
                </div>
                <div class="col form-check">
                    <input class="form-check-input" type="checkbox" id="has_wifi" name="has_wifi" <?php if ($lodgingWifi == 1) { ?> checked <?php } ?>>
                    <label class="form-check-label" for="has_wifi"> Wifi </label>
                </div>
                <div class="col form-check">
                    <input class="form-check-input" type="checkbox" id="has_kitchen" name="has_kitchen" <?php if ($lodgingKitchen == 1) { ?> checked <?php } ?>>
                    <label class="form-check-label" for="has_kitchen">Cuisine</label>
                </div>
                <div class="col form-check">
                    <input class="form-check-input" type="checkbox" id="has_aircon" name="has_aircon" <?php if ($lodgingAircon == 1) { ?> checked <?php } ?>>
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
                    <label for="price">Prix/nuit</label><small class="error"><?php if (isset($capacityErr)) echo $capacityErr ?></small>
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