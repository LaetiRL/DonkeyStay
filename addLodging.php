<?php
$titleWeb = "Ajouter un logement";
require_once "header.php";

if(!isset($_SESSION['name'])) {
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}

$has_tv = 0;
$has_wifi = 0;
$has_kitchen = 0;
$has_aircon = 0;

if (isset($_POST['add']) && isset($_SESSION['name'])) {
    $homeTypeId = $_POST['home_type'];
    $roomTypeId = $_POST['room_type'];
    $userId = $_SESSION['user_id'];
    if (!empty($_POST['title'])) {
        $title = $_POST['title'];
    } else {
        $titleErr = " * champ obligatoire";
    }
   /*  if (!empty($_POST['img'])) {
        $img = $_POST['img'];
    } else {
        $imgErr = " * champ obligatoire";
    } */
    if (!empty($_POST['capacity']) && is_numeric($_POST['capacity'])) {
        $capacity_id = $_POST['capacity'];
    } elseif (empty($_POST['capacity'])) {
        $capacityErr = " * champ obligatoire";
    } elseif (is_numeric($_POST['capacity']) == false) {
        $capacityErr = " * veuillez n'entrer que des chiffres";
    }
    if (!empty($_POST['nb_bedroom']) && is_numeric($_POST['nb_bedroom'])) {
        $nb_bedroom = $_POST['nb_bedroom'];
    } elseif (empty($_POST['nb_bedroom'])) {
        $nb_bedroomErr = " * champ obligatoire";
    } elseif (is_numeric($_POST['nb_bedroom']) == false) {
        $nb_bedroomErr = " * veuillez n'entrer que des chiffres";
    }
    if (!empty($_POST['nb_bathroom']) && is_numeric($_POST['nb_bathroom'])) {
        $nb_bathroom = $_POST['nb_bathroom'];
    } elseif (empty($_POST['nb_bathroom'])) {
        $nb_bathroomErr = " * champ obligatoire";
    } elseif (is_numeric($_POST['nb_bathroom']) == false) {
        $nb_bathroomErr = " * veuillez n'entrer que des chiffres";
    }
    if (!empty($_POST['has_tv'])) {
        $has_tv = 1;
    }
    if (!empty($_POST['has_wifi'])) {
        $has_wifi = 1;
    }
    if (!empty($_POST['has_kitchen'])) {
        $has_kitchen = 1;
    }
    if (!empty($_POST['has_aircon'])) {
        $has_aircon = 1;
    }
    if (!empty($_POST['description'])) {
        $description = $_POST['description'];
    } else {
        $descriptionErr = " * champ obligatoire";
    }
    if (!empty($_POST['adress'])) {
        $adress = $_POST['adress'];
    } else {
        $adressErr = " * champ obligatoire";
    }
    if (!empty($_POST['city'])) {
        $city = $_POST['city'];
    } else {
        $cityErr = " * champ obligatoire";
    }
    if (!empty($_POST['start_dispo'])) {
        $start_dispo = $_POST['start_dispo'];
    } else {
        $start_dispoErr = " * champ obligatoire";
    }
    if (!empty($_POST['end_dispo'])) {
        $end_dispo = $_POST['end_dispo'];
    } else {
        $end_dispoErr = " * champ obligatoire";
    }
    if (!empty($_POST['price']) && is_numeric($_POST['price'])) {
        $price = $_POST['price'];
    } elseif (empty($_POST['price'])) {
        $priceErr = " * champ obligatoire";
    } elseif (is_numeric($_POST['price']) == false) {
        $priceErr = " * veuillez n'entrer que des chiffres";
    }

    if (
        !isset($titleErr) && !isset($imgErr) && !isset($capacityErr)
        && !isset($nb_bedroomErr) && !isset($nb_bathroomErr) && !isset($descriptionErr)
        && !isset($adressErr) && !isset($cityErr) && !isset($start_dispoErr)
        && !isset($end_dispoErr) && !isset($priceErr)
    ) {

        $queryInsert = $dbh->prepare("INSERT INTO room (`roomtype_id`, `hometype_id`, `user_id`, `title`, `capacity_id` ,`nb_bedroom`, `nb_bathroom`, `description`,`has_tv`, `has_wifi`, `has_kitchen`, `has_aircon`, `adress`, `city`, `start_dispo`, `end_dispo`, `price`) VALUES (:roomTypeId, :homeTypeId, :userId, :title, :capacity, :nb_bedroom, :nb_bathroom, :description, :has_tv, :has_wifi, :has_kitchen, :has_aircon, :adress, :city, :start_dispo, :end_dispo, :price)");

        $queryInsert->bindValue(":roomTypeId", $roomTypeId, PDO::PARAM_INT);
        $queryInsert->bindValue(":homeTypeId", $homeTypeId, PDO::PARAM_INT);
        $queryInsert->bindValue(":userId", $userId, PDO::PARAM_INT);
        $queryInsert->bindValue(":title", $title, PDO::PARAM_STR);
        $queryInsert->bindValue(":capacity", $capacity_id, PDO::PARAM_INT);
        $queryInsert->bindValue(":nb_bedroom", $nb_bedroom, PDO::PARAM_INT);
        $queryInsert->bindValue(":nb_bathroom", $nb_bathroom, PDO::PARAM_INT);
        $queryInsert->bindValue(":description", $description, PDO::PARAM_STR);
        $queryInsert->bindValue(":has_tv", $has_tv, PDO::PARAM_STR);
        $queryInsert->bindValue(":has_wifi", $has_wifi, PDO::PARAM_STR);
        $queryInsert->bindValue(":has_kitchen", $has_kitchen, PDO::PARAM_STR);
        $queryInsert->bindValue(":has_aircon", $has_aircon, PDO::PARAM_STR);
        $queryInsert->bindValue(":adress", $adress, PDO::PARAM_STR);
        $queryInsert->bindValue(":city", $city, PDO::PARAM_STR);
        $queryInsert->bindValue(":start_dispo", $start_dispo, PDO::PARAM_STR);
        $queryInsert->bindValue(":end_dispo", $end_dispo, PDO::PARAM_STR);
        $queryInsert->bindValue(":price", $price, PDO::PARAM_STR);

        $queryInsert->execute();

        $room_id = $dbh->lastInsertId();

        $targetDir = "img/logements/"; 
        $allowTypes = array('jpg','png','jpeg'); 
        
        $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
        $fileNames = array_filter($_FILES['img']['name']); 
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
                        $insertValuesSQL .= "('".$targetDir.$fileName."',".$room_id."),"; 
                    }else{ 
                        $errorUpload .= $_FILES['img']['name'][$key].' | '; 
                    } 
                }else{ 
                    $errorUploadType .= $_FILES['img']['name'][$key].' | '; 
                } 
            } 
            
            // Error message 
            $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
            $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
            $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
            
            if(!empty($insertValuesSQL)){ 
                $insertValuesSQL = trim($insertValuesSQL, ','); 
                // Insert image file name into database 
                $insert = $dbh->query("INSERT INTO image (img, room_id) VALUES $insertValuesSQL"); 
                if($insert){ 
                    $statusMsg = "Files are uploaded successfully.".$errorMsg; 
                }else{ 
                    $statusMsg = "Sorry, there was an error uploading your file."; 
                } 
            }else{ 
                $statusMsg = "Upload failed! ".$errorMsg; 
            } 
        }else{ 
            $statusMsg = 'Please select a file to upload.'; 
        } 
    
        echo "<script type='text/javascript'>document.location.replace('lodging.php');</script>";
    }
} 
?>

<section>
    <h1>Ajouter un logement</h1>
    <hr>
    <form method="POST" class="d-flex j-c" enctype="multipart/form-data">
        <div class="div-addform">
            <div class="row">
                <div class="col">
                    <label for="title">Titre</label><small class="error"><?php if(isset($titleErr)) echo $titleErr ?></small>
                    <input type="text" class="form-control" id="title" name="title" value="<?php if(isset($title)) echo $title ?>">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="img">Images</label><small class="error"><?php if(isset($imgErr)) echo $imgErr ?></small>
                    <input type="file" id="img" name="img[]" multiple value="<?php if(isset($img)) echo $img ?>">
                    <!-- <label for="img">Images</label><small class="error"><?php if(isset($imgErr)) echo $imgErr ?></small>
                    <input type="text" class="form-control" id="img" name="img" value="<?php if(isset($img)) echo $img ?>"> -->
                </div>
            </div>
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
                    <label for="capacity">Capacité</label><small class="error"><?php if(isset($capacityErr)) echo $capacityErr ?></small>
                    <input type="text" class="form-control" id="capacity" name="capacity" value="<?php if (isset($capacity_id)) echo $capacity_id ?>">
                </div>
                <div class="col">
                    <label for="nb_bedroom">nb de Chambres</label><small class="error"><?php if(isset($nb_bedroomErr)) echo $nb_bedroomErr ?></small>
                    <input type="text" class="form-control" id="nb_bedroom" name="nb_bedroom" value="<?php if (isset($nb_bedroom)) echo $nb_bedroom ?>">
                </div>
                <div class="col">
                    <label for="nb_bathroom">nb de Salles de bain</label><small class="error"><?php if(isset($nb_bathroomErr)) echo $nb_bathroomErr ?></small>
                    <input type="text" class="form-control" id="nb_bathroom" name="nb_bathroom" value="<?php if (isset($nb_bathroom)) echo $nb_bathroom ?>">
                </div>
            </div>
            <div class="row">
                <div class="col form-check">
                    <input class="form-check-input" type="checkbox" id="has_tv" name="has_tv" <?php if($has_tv == 1) {?> checked <?php }?>>
                    <label class="form-check-label" for="has_tv"> TV </label>
                </div>
                <div class="col form-check">
                    <input class="form-check-input" type="checkbox" id="has_wifi" name="has_wifi" <?php if($has_wifi == 1) {?> checked <?php }?>>
                    <label class="form-check-label" for="has_wifi"> Wifi </label>
                </div>
                <div class="col form-check">
                    <input class="form-check-input" type="checkbox" id="has_kitchen" name="has_kitchen" <?php if($has_kitchen == 1) {?> checked <?php }?>>
                    <label class="form-check-label" for="has_kitchen">Cuisine</label>
                </div>
                <div class="col form-check">
                    <input class="form-check-input" type="checkbox" id="has_aircon" name="has_aircon" <?php if($has_aircon == 1) {?> checked <?php }?>>
                    <label class="form-check-label" for="has_aircon">Climatisation</label>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="description" class="form-label">Description</label><small class="error"><?php if(isset($descriptionErr)) echo $descriptionErr ?></small>
                    <textarea class="form-control" id="description" name="description" rows="3"><?php if (isset($description)) echo $description ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <label for="adress">Adresse</label><small class="error"><?php if(isset($adressErr)) echo $adressErr ?></small>
                    <input type="text" class="form-control" id="adress" name="adress" value="<?php if(isset($adress)) echo $adress ?>">
                </div>
                <div class="col-sm-4">
                    <label for="city">Ville</label><small class="error"><?php if(isset($cityErr)) echo $cityErr ?></small>
                    <input type="text" class="form-control" id="city" name="city" value="<?php if(isset($city)) echo $city ?>">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="start_dispo">Première disponibilité</label><small class="error"><?php if(isset($start_dispoErr)) echo $start_dispoErr ?></small><br>
                    <input type="date" id="start_dispo" name="start_dispo" value="<?php if(isset($start_dispo)) echo $start_dispo ?>">
                </div>
                <div class="col">
                    <label for="end_dispo">Dernière disponibilité</label><small class="error"><?php if(isset($end_dispoErr)) echo $end_dispoErr ?></small><br>
                    <input type="date" id="end_dispo" name="end_dispo" value="<?php if(isset($end_dispo)) echo $end_dispo ?>">
                </div>
                <div class="col">
                    <label for="price">Prix/nuit</label><small class="error"><?php if(isset($priceErr)) echo $priceErr ?></small>
                    <input type="text" class="form-control" id="price" name="price" value="<?php if(isset($price)) echo $price ?>">
                </div>
            </div>
            <button type="submit" name="add">+ Ajouter</button>
        </div>
    </form>

    <style>
        body {
            background-color: lightgrey;
        }
    </style>