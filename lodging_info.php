<?php
$titleWeb ='En savoir plus';
require "searchBar.php";

$idUrl = $_GET['id'];

$lodgingInfoQuery = $dbh->query("SELECT room.*,img,rname,hname,nb_traveler  FROM room INNER JOIN image ON image.room_id = room.id INNER JOIN roomtype ON roomtype.id = room.roomtype_id INNER JOIN hometype ON hometype.id = room.hometype_id INNER JOIN capacity ON capacity.id = room.capacity_id WHERE room.id = $idUrl");
$lodgingInfos = $lodgingInfoQuery->fetch();



$imageQuery = $dbh->query("SELECT * FROM image WHERE room_id = $idUrl ORDER BY RAND()");
$images = $imageQuery->fetchAll(PDO::FETCH_ASSOC);
$nbImg = count($images);



?>

    <section>

        <div class="container">
            <h1><?php echo $lodgingInfos['title']?></h1>
            <small><?php echo $lodgingInfos['city'].", disponible du ".$lodgingInfos['start_dispo']." au ".$lodgingInfos['end_dispo']?></small>
            <!-- start user lodging gallery -->
            <div class="row">
                <div class="col-md-4 mt-3 col-lg-6">
                    <img src="<?php echo $lodgingInfos['img']?>" class="img-fluid w-100 h-100" alt="image">
                </div>
                <div class="col-md-4 col-lg-6">
                    <div class="row">
                        <div class="col-md-4 mt-3 col-lg-6">
                            <div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner lodging-img">
                                    <?php
                                        echo '<div class="carousel-item h-100 active" data-bs-interval="4000">';
                                            echo '<img src="'.$images[rand(0, $nbImg - 1)]['img'].'" class="d-block w-100 h-100" alt="pyramide du Louvre">';
                                        echo '</div>';
                                        foreach ($images as $image) {
                                            echo '<div class="carousel-item h-100" data-bs-interval="4000">';
                                                echo '<img src="'.$images[rand(0, $nbImg - 1)]['img'].'" class="d-block w-100 h-100" alt="calanque de Marseille">';
                                            echo '</div>';
                                        }
                                    ?>
                                </div>  
                            </div>
                        </div>
                        <div class="col-md-4 mt-3 col-lg-6">
                            <div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner lodging-img">
                                    <?php
                                        echo '<div class="carousel-item h-100 active" data-bs-interval="3000">';
                                            echo '<img src="'.$images[rand(0, $nbImg - 1)]['img'].'" class="d-block w-100 h-100" alt="pyramide du Louvre">';
                                        echo '</div>';
                                        foreach ($images as $image) {
                                            echo '<div class="carousel-item h-100" data-bs-interval="3000">';
                                                echo '<img src="'.$images[rand(0, $nbImg - 1)]['img'].'" class="d-block w-100 h-100" alt="calanque de Marseille">';
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3 col-lg-6">
                            <div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner lodging-img">
                                    <?php
                                        echo '<div class="carousel-item h-100 active" data-bs-interval="5000">';
                                            echo '<img src="'.$images[rand(0, $nbImg - 1)]['img'].'" class="d-block w-100 h-100" alt="pyramide du Louvre">';
                                        echo '</div>';
                                        foreach ($images as $image) {
                                            echo '<div class="carousel-item h-100" data-bs-interval="5000">';
                                                echo '<img src="'.$images[rand(0, $nbImg - 1)]['img'].'" class="d-block w-100 h-100" alt="calanque de Marseille">';
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3 col-lg-6">
                            <div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner lodging-img">
                                    <?php
                                        echo '<div class="carousel-item active h-100" data-bs-interval="6000">';
                                            echo '<img src="'.$images[rand(0, $nbImg - 1)]['img'].'" class="d-block w-100 h-100" alt="pyramide du Louvre">';
                                        echo '</div>';
                                        foreach ($images as $image) {
                                            echo '<div class="carousel-item h-100" data-bs-interval="6000">';
                                                echo '<img src="'.$images[rand(0, $nbImg - 1)]['img'].'" class="d-block w-100 h-100" alt="calanque de Marseille">';
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end user lodging gallery -->
        </div>

        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-8">
                    <h2><?php echo $lodgingInfos['hname'].": ".$lodgingInfos['rname']?></h2>
                    <small><?php echo "Capacité: ".$lodgingInfos['nb_traveler']." - Chambre(s): ".$lodgingInfos['nb_bedroom']." - Salle(s) de bain: ".$lodgingInfos['nb_bathroom']?></small>
                    <hr>
                    <p><?php echo $lodgingInfos['description']?></p>
                    <hr>
                    <small>Equipement(s): 
                        <?php 
                            if ($lodgingInfos['has_tv'] === 1) {
                                echo " TV ";
                            }
                            if ($lodgingInfos['has_wifi'] === 1) {
                                echo " Wifi ";
                            }
                            if ($lodgingInfos['has_kitchen'] === 1) {
                                echo " Cuisine ";
                            }
                            if ($lodgingInfos['has_aircon'] === 1) {
                                echo " Climatisation ";
                            }
                        ?>
                    </small>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <form method="post">
                            <h3><?php echo $lodgingInfos['price']."€/ nuit"?></h3>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="startDate">Départ:</label><br>
                                    <input type="date" id="startDate" />
                                </div>
                                <div class="col-lg-6">
                                    <label for="endDate">Retour:</label><br>
                                    <input type="date" id="endDate" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Voyageurs</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <?php
                                            $capacityQuery = $dbh->query('SELECT * FROM capacity ORDER BY id');
                                            $capacity= $capacityQuery->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($capacity as $row_capacity) {
                                                echo '<option value="'.$row_capacity['id'].'">'.$row_capacity['nb_traveler'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row m-i">
                                <button class="btn btn-danger btn-block" type="submit" name="search">Réserver</button> 
                            </div>
                            <div class="form-check">
                                <label class="form-check-label col-10" for="pet_option"> Option animaux</label>
                                <input class="form-check-input" type="checkbox" id="pet_option" name="pet_option">
                                <span>+ 20€</span>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label col-10" for="cancel_option"> Assurance annulation</label>
                                <input class="form-check-input" type="checkbox" id="cancel_option" name="cancel_option">
                                <span>+ 2,5€</span>
                            </div>
                            <hr>
                            <div>
                                <span>Prix total: </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </section>

    <hr>
<?php
require "footer.php";
?>
