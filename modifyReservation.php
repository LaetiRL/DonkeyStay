<?php
$titleWeb = 'Modifier ma Réservation';
require_once 'searchBar.php';
require_once '_secured.php';

$idUrl = $_GET['id'];

$lodgingInfoQuery = $dbh->query("SELECT booking.*, room.*,img,rname,hname,nb_traveler  FROM room INNER JOIN booking ON booking.room_id = room.id INNER JOIN image ON image.room_id = room.id INNER JOIN roomtype ON roomtype.id = room.roomtype_id INNER JOIN hometype ON hometype.id = room.hometype_id INNER JOIN capacity ON capacity.id = room.capacity_id WHERE booking.id = $idUrl");
$lodgingInfos = $lodgingInfoQuery->fetch();

$img = $lodgingInfos['room_id'];

$imageQuery = $dbh->query("SELECT * FROM image WHERE room_id = $img ORDER BY RAND()");
$images = $imageQuery->fetchAll(PDO::FETCH_ASSOC);
$nbImg = count($images);

$startDispo = new DateTime($lodgingInfos['start_dispo']);
$endDispo = new DateTime($lodgingInfos['end_dispo']);

?>
<section class="logements">
    <div class="container">
        <h1><?php echo $lodgingInfos['title'] ?></h1>
        <small><?php echo $lodgingInfos['city'] . ", disponible du " . $startDispo->format('d/m/Y') . " au " . $endDispo->format('d/m/Y') ?></small>
        <!-- start user lodging gallery -->
        <div class="row">
            <div class="col-md-4 mt-3 col-lg-6 lodging-img-lg">
                <img src="<?php echo $lodgingInfos['img'] ?>" class="img-fluid w-100 h-100" alt="image">
            </div>
            <div class="col-md-4 col-lg-6">
                <div class="row">
                    <div class="col-md-4 mt-3 col-lg-6">
                        <div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner lodging-img">
                                <div class="carousel-item h-100 active" data-bs-interval="4000">
                                    <img src="<?php echo $images[rand(0, $nbImg - 1)]['img'] ?>" class="d-block w-100 h-100" alt="pyramide du Louvre">
                                </div>
                                <?php
                                foreach ($images as $image) {
                                ?>
                                    <div class="carousel-item h-100" data-bs-interval="4000">
                                        <img src="<?php echo $images[rand(0, $nbImg - 1)]['img'] ?>" class="d-block w-100 h-100" alt="calanque de Marseille">
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-3 col-lg-6">
                        <div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner lodging-img">
                                <div class="carousel-item h-100 active" data-bs-interval="5000">
                                    <img src="<?php echo $images[rand(0, $nbImg - 1)]['img'] ?>" class="d-block w-100 h-100" alt="pyramide du Louvre">
                                </div>
                                <?php
                                foreach ($images as $image) {
                                ?>
                                    <div class="carousel-item h-100" data-bs-interval="5000">
                                        <img src="<?php echo $images[rand(0, $nbImg - 1)]['img'] ?>" class="d-block w-100 h-100" alt="calanque de Marseille">
                                    </div>
                                <?php
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
                                <div class="carousel-item h-100 active" data-bs-interval="6000">
                                    <img src="<?php echo $images[rand(0, $nbImg - 1)]['img'] ?>" class="d-block w-100 h-100" alt="pyramide du Louvre">
                                </div>
                                <?php
                                foreach ($images as $image) {
                                ?>
                                    <div class="carousel-item h-100" data-bs-interval="6000">
                                        <img src="<?php echo $images[rand(0, $nbImg - 1)]['img'] ?>" class="d-block w-100 h-100" alt="calanque de Marseille">
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-3 col-lg-6">
                        <div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner lodging-img">
                                <div class="carousel-item h-100 active" data-bs-interval="3000">
                                    <img src="<?php echo $images[rand(0, $nbImg - 1)]['img'] ?>" class="d-block w-100 h-100" alt="pyramide du Louvre">
                                </div>
                                <?php
                                foreach ($images as $image) {
                                ?>
                                    <div class="carousel-item h-100" data-bs-interval="3000">
                                        <img src="<?php echo $images[rand(0, $nbImg - 1)]['img'] ?>" class="d-block w-100 h-100" alt="calanque de Marseille">
                                    </div>
                                <?php
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
    <?php


if (isset($_POST['booking']) && isset($_SESSION['name'])) {
    $user_id = $_SESSION['user_id'];
    $room_id = $lodgingInfos['id'];
    $start_date = $_POST['infoStartDate'];
    $end_date = $_POST['infoEndDate'];
    $start_date_calc = new DateTime($_POST['infoStartDate']);
    $end_date_calc = new DateTime($_POST['infoEndDate']);
    $nb_night = ($end_date_calc ->diff($start_date_calc))->format('%a');
    $pet_option_calc = !empty($_POST['pet_option']) ? 20 : 0;
    $cancel_option_calc = !empty($_POST['cancel_option']) ? 2.5 : 0;
    $total_price = ($nb_night * $lodgingInfos['price']) + $pet_option_calc + $cancel_option_calc;
    $pet_option = !empty($_POST['pet_option']) ? 1 : 0;
    $cancel_option = !empty($_POST['cancel_option']) ? 1 : 0;
    $travelers = $_POST['selectTravelers'];

    if ($total_price != 0 && isset($_SESSION['user_id'])) {

        $queryBooking = $dbh->prepare("UPDATE booking SET start_date =:start_date, end_date =:end_date, nb_person =:travelers, total_price =:total_price, update_date = NOW(), pet_option =:pet_option, cancel_option =:cancel_option WHERE id =:idUrl");

        $queryBooking->bindValue(":start_date", $start_date, PDO::PARAM_STR);
        $queryBooking->bindValue(":end_date", $end_date, PDO::PARAM_STR);
        $queryBooking->bindValue(":travelers", $travelers, PDO::PARAM_INT);
        $queryBooking->bindValue(":total_price", $total_price, PDO::PARAM_STR);
        $queryBooking->bindValue(":idUrl", $idUrl, PDO::PARAM_INT);
        $queryBooking->bindValue(":pet_option", $pet_option, PDO::PARAM_INT);
        $queryBooking->bindValue(":cancel_option", $cancel_option, PDO::PARAM_INT);

        $queryBooking->execute();

        echo "<script type='text/javascript'>document.location.replace('reservation.php');</script>";
    }
}

?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-8">
                <h2><?php echo $lodgingInfos['hname'] . ": " . $lodgingInfos['rname'] ?></h2>
                <small><?php echo "Capacité: " . $lodgingInfos['nb_traveler'] . " - Chambre(s): " . $lodgingInfos['nb_bedroom'] . " - Salle(s) de bain: " . $lodgingInfos['nb_bathroom'] ?></small>
                <hr>
                <p><?php echo $lodgingInfos['description'] ?></p>
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
                        <h3><?php echo $lodgingInfos['price'] . "€/ nuit" ?></h3>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="infoStartDate">Départ:</label><br>
                                <input type="date" id="infoStartDate" name="infoStartDate" min='<?= $currentDate; ?>' value='<?= $lodgingInfos['start_date'] ?>' />
                            </div>
                            <div class="col-lg-6">
                                <label for="infoEndDate">Retour:</label><br>
                                <input type="date" id="infoEndDate" name="infoEndDate" min='<?= $currentDate; ?>' value='<?= $lodgingInfos['end_date'] ?>' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="selectTravelers">Voyageurs</label>
                                <select class="form-control" id="selectTravelers" name="selectTravelers">
                                    <?php
                                    $capacityQuery = $dbh->query('SELECT * FROM capacity ORDER BY id');
                                    $capacity = $capacityQuery->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($capacity as $row_capacity) {
                                        echo '<option value="' . $row_capacity['id'] . '">' . $row_capacity['nb_traveler'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label col-10" for="pet_option"> Option animaux</label>
                            <input class="form-check-input" type="checkbox" id="pet_option" name="pet_option" <?php if ($lodgingInfos['pet_option'] == 1) { ?> checked <?php } ?>>
                            <span>+ 20€</span>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label col-10" for="cancel_option"> Assurance annulation</label>
                            <input class="form-check-input" type="checkbox" id="cancel_option" name="cancel_option" <?php if ($lodgingInfos['cancel_option'] == 1) { ?> checked <?php } ?>>
                            <span>+ 2,5€</span>
                        </div>
                        <div class="row m-i">
                            <button class="btn btn-primary btn-block" type="submit" name="booking" onclick="return confirm('Valider la réservation ?');">Modifier</button>
                        </div>
                        <hr>
                        <div>Prix total avant modification : <?php echo $lodgingInfos['total_price'] ?> €</div>
                        <div>
                            <span>Prix total après modification : </span><span id="totalPrice"></span>
                            <script>
                                function getPrice(infoStartDate, infoEndDate, price, petOption, cancelOption) {
                                    $.ajax({
                                        type: "POST",
                                        url: "_totalPrice.php",
                                        data: {
                                            infoStartDate: infoStartDate,
                                            infoEndDate: infoEndDate,
                                            price: price,
                                            petOption: petOption ? 1 : 0,
                                            cancelOption: cancelOption ? 1 : 0,
                                        },
                                        success: function(total) {
                                            console.log("SUCCESS ", total);
                                            $('#totalPrice').html(total + '€');

                                        },
                                        error: function() {
                                            console.log("Error ", data);
                                            $('#totalPrice').html("Désolé, aucun résultat trouvé.");
                                        }
                                    })
                                }

                                $(document).ready(function() {
                                    $("#infoEndDate").change(function() {
                                        getPrice(
                                            $("#infoStartDate").val(),
                                            $("#infoEndDate").val(),
                                            <?php echo $lodgingInfos['price']; ?>,
                                            document.getElementById("pet_option").checked,
                                            document.getElementById("cancel_option").checked
                                        );
                                    })
                                })

                                $(document).ready(function() {
                                    $("#pet_option").change(function() {
                                        getPrice(
                                            $("#infoStartDate").val(),
                                            $("#infoEndDate").val(),
                                            <?php echo $lodgingInfos['price']; ?>,
                                            document.getElementById("pet_option").checked,
                                            document.getElementById("cancel_option").checked
                                        );
                                        console.log(document.getElementById("pet_option").checked);

                                    })
                                })
                                $(document).ready(function() {
                                    $("#cancel_option").change(function() {
                                        getPrice(
                                            $("#infoStartDate").val(),
                                            $("#infoEndDate").val(),
                                            <?php echo $lodgingInfos['price']; ?>,
                                            document.getElementById("pet_option").checked,
                                            document.getElementById("cancel_option").checked
                                        );
                                        console.log(document.getElementById("cancel_option").checked);
                                    })
                                })
                            </script>
                        </div>
                        <p class="error"><?php if (isset($error)) echo $error ?></p>
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