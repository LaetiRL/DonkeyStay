<?php
$titleWeb = 'En savoir plus';
require_once 'searchBar.php';
require_once "class/Month.php";
require_once "class/Bookings.php";

$idUrl = $_GET['id'];

$lodgingInfoQuery = $dbh->query("SELECT room.*,img,rname,hname,nb_traveler  FROM room INNER JOIN image ON image.room_id = room.id INNER JOIN roomtype ON roomtype.id = room.roomtype_id INNER JOIN hometype ON hometype.id = room.hometype_id INNER JOIN capacity ON capacity.id = room.capacity_id WHERE room.id = $idUrl");
$lodgingInfos = $lodgingInfoQuery->fetch();


$imageQuery = $dbh->query("SELECT * FROM image WHERE room_id = $idUrl ORDER BY RAND()");
$images = $imageQuery->fetchAll(PDO::FETCH_ASSOC);
$nbImg = count($images);

$startDispo = new DateTime($lodgingInfos['start_dispo']);
$endDispo = new DateTime($lodgingInfos['end_dispo']);

?>
<section>
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
                                <div class="carousel-item h-100 active" data-bs-interval="3000">
                                    <img src="<?php echo $images[rand(0, $nbImg - 1)]['img'] ?>" class="d-block w-100 h-100" alt="photo du logement">
                                </div>
                                <?php
                                foreach ($images as $image) {
                                ?>
                                    <div class="carousel-item h-100" data-bs-interval="3000">
                                        <img src="<?php echo $images[rand(0, $nbImg - 1)]['img'] ?>" class="d-block w-100 h-100" alt="photo du logement">
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
                                    <img src="<?php echo $images[rand(0, $nbImg - 1)]['img'] ?>" class="d-block w-100 h-100" alt="photo du logement">
                                </div>
                                <?php
                                foreach ($images as $image) {
                                ?>
                                    <div class="carousel-item h-100" data-bs-interval="6000">
                                        <img src="<?php echo $images[rand(0, $nbImg - 1)]['img'] ?>" class="d-block w-100 h-100" alt="photo du logement">
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
                                <div class="carousel-item h-100 active" data-bs-interval="4000">
                                    <img src="<?php echo $images[rand(0, $nbImg - 1)]['img'] ?>" class="d-block w-100 h-100" alt="photo du logement">
                                </div>
                                <?php
                                foreach ($images as $image) {
                                ?>
                                    <div class="carousel-item h-100" data-bs-interval="4000">
                                        <img src="<?php echo $images[rand(0, $nbImg - 1)]['img'] ?>" class="d-block w-100 h-100" alt="photo du logement">
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
    require_once "class/Month.php";
    require_once "class/Bookings.php";

    $bookings = new Bookings;
    $month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);
    $start = $month->getStartingDay();
    $start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
    $weeks = $month->getWeeks();
    $end = (clone $start)->modify('+' . (6 + 7 * ($weeks - 1)) . ' days');
    $bookings = $bookings->getBookingsBetween($start, $end);

    foreach ($bookings as $booking) {
        $start_resa = date_create($booking['start_date']);
        $end_resa = date_create($booking['end_date']);
        $interval = DateInterval::createFromDateString('1 day');
        $date_resa = new DatePeriod($start_resa, $interval,  $end_resa);
        $tableau = [];

        foreach ($date_resa as $date) {

            $tableau[] = $date->format('Y-m-d');
        }
    }
    if (empty($tableau)) {
        $tableau = [];
    }



    if (isset($_POST['booking']) && !isset($_SESSION['name'])) {
        $error = " * Veuillez vous connecter";
    }

    if (isset($_POST['booking']) && isset($_SESSION['name'])) {
        $user_id = $_SESSION['user_id'];
        $room_id = $lodgingInfos['id'];
        $start_date = $_POST['infoStartDate'];
        $end_date = $_POST['infoEndDate'];
        $start_date_calc = new DateTime($_POST['infoStartDate']);
        $end_date_calc = new DateTime($_POST['infoEndDate']);
        $nb_night = ($end_date_calc->diff($start_date_calc))->format('%a');
        $pet_option_calc = !empty($_POST['pet_option']) ? 20 : 0;
        $cancel_option_calc = !empty($_POST['cancel_option']) ? 2.5 : 0;
        $total_price = ($nb_night * $lodgingInfos['price']) + $pet_option_calc + $cancel_option_calc;
        $pet_option = !empty($_POST['pet_option']) ? 1 : 0;
        $cancel_option = !empty($_POST['cancel_option']) ? 1 : 0;
        $travelers = $_POST['selectTravelers'];

        if (!in_array($start_date, $tableau) && !in_array($end_date, $tableau)) {

            if ($total_price != 0 && isset($_SESSION['user_id'])) {

                $queryBooking = $dbh->prepare("INSERT INTO booking (`user_id`, `room_id`, `start_date`, `end_date`, `nb_person`,`total_price`, `booking_date`, `create_date`, `update_date`, `pet_option`, `cancel_option`) VALUES ($user_id, $room_id, :start_date, :end_date, :travelers, :total_price, NOW(), NOW(), NOW(), :pet_option, :cancel_option)");

                $queryBooking->bindValue(":start_date", $start_date, PDO::PARAM_STR);
                $queryBooking->bindValue(":end_date", $end_date, PDO::PARAM_STR);
                $queryBooking->bindValue(":travelers", $travelers, PDO::PARAM_INT);
                $queryBooking->bindValue(":total_price", $total_price, PDO::PARAM_STR);
                $queryBooking->bindValue(":pet_option", $pet_option, PDO::PARAM_INT);
                $queryBooking->bindValue(":cancel_option", $cancel_option, PDO::PARAM_INT);

                $queryBooking->execute();

                echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
            }
        }
        $dateErr = 'Les dates choisies ne sont pas disponibles';
    }

    ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-8">
                <h2><?php echo $lodgingInfos['hname'] . ": " . $lodgingInfos['rname'] ?></h2>
                <small><?php echo "Capacit??: " . $lodgingInfos['nb_traveler'] . " - Chambre(s): " . $lodgingInfos['nb_bedroom'] . " - Salle(s) de bain: " . $lodgingInfos['nb_bathroom'] ?></small>
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
                <br><br>
                <h4><?= $month->toString() ?></h4>
                <div class="d-flex">
                    <a href="lodging_info.php?id=<?php echo $idUrl ?>&month=<?php echo $month->previousMonth()->month; ?>&year=<?php echo $month->previousMonth()->year; ?>" class="btn ms-3">&lt</a>
                    <a href="lodging_info.php?id=<?php echo $idUrl ?>&month=<?php echo $month->nextMonth()->month; ?>&year=<?php echo $month->nextMonth()->year; ?>" class="btn ms-3">&gt</a>
                </div>
                <table>
                    <th>L</th>
                    <th>M</th>
                    <th>M</th>
                    <th>J</th>
                    <th>V</th>
                    <th>S</th>
                    <th>D</th>
                    <?php for ($i = 0; $i < $weeks; $i++) : ?>
                        <tr>
                            <?php foreach ($month->days as $k => $day) :
                                $date = (clone $start)->modify("+" . ($k + $i * 7) . " days");
                                $bookingsC = $bookings[$date->format('Y-m-d')] ?? [];
                            ?>
                                <td class="<?php echo $month->withinMonth($date) ? '' : 'calendar-othermonth '; ?><?php echo in_array($date->format('Y-m-d'), $tableau) ? 'calendar-resa' : ''; ?>">
                                    <div><?php echo $date->format('d'); ?></div>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endfor; ?>
                </table>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <form method="post">
                        <h3><?php echo $lodgingInfos['price'] . "???/ nuit" ?></h3>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="infoStartDate">D??part:</label><br>
                                <input type="date" id="infoStartDate" name="infoStartDate" min='<?= $currentDate; ?>' value='<?= $currentDate; ?>' />
                            </div>
                            <div class="col-lg-6">
                                <label for="infoEndDate">Retour:</label><br>
                                <input type="date" id="infoEndDate" name="infoEndDate" min='<?= $currentDate; ?>' value='<?= $currentDate; ?>' />
                            </div>
                        </div>
                        <p class="error"><?php if (isset($dateErr)) echo $dateErr ?></p>
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
                            <input class="form-check-input" type="checkbox" id="pet_option" name="pet_option">
                            <span>+ 20???</span>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label col-10" for="cancel_option"> Assurance annulation</label>
                            <input class="form-check-input" type="checkbox" id="cancel_option" name="cancel_option">
                            <span>+ 2,5???</span>
                        </div>
                        <div class="row m-i">
                            <button class="btn btn-primary btn-block" type="submit" name="booking">R??server</button>
                        </div>
                        <hr>
                        <div>
                            <span>Prix total: </span><span id="totalPrice"></span>
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
                                            $('#totalPrice').html(total + '???');

                                        },
                                        error: function() {
                                            console.log("Error ", data);
                                            $('#totalPrice').html("D??sol??, aucun r??sultat trouv??.");
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