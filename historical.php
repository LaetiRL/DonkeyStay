<?php

$titleWeb = "Mes Réservations";
require_once 'searchBar.php';
require_once '_secured.php';
$user_id = $_SESSION['user_id'];

$resaQuery = "SELECT room.*, booking.* FROM booking INNER JOIN room ON booking.room_id = room.id WHERE booking.user_id =:userId AND end_date < NOW() ORDER BY start_date";

$stmPast = $dbh->prepare($resaQuery);
$stmPast->bindValue(":userId", $user_id, PDO::PARAM_INT);
$stmPast->execute();
$PastResas = $stmPast->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="logements">
    <h1 class="h2-index mb-4">Mes Réservations</h1>
    <div class="d-flex j-c">
        <a href="/reservation.php"><button type="button" class="btn btn-secondary mx-2">À venir</button></a>
        <a href="/historical.php"><button type="button" class="btn btn-secondary-2 mx-2">Historique</button></a>
    </div>
    <h2 class="mt-5 h2-index">Mon historique</h2>
    <div class="container d-flex">
        <div class="mx-1 lodging-d-flex-div">
            <?php
            foreach ($PastResas as $PastResa) {

                $startDate = new DateTime($PastResa['start_date']);
                $endDate = new DateTime($PastResa['end_date']);

                $lastestAddImgQuery = $dbh->query('SELECT * FROM image WHERE room_id =' . $PastResa['room_id'] . ' LIMIT 1');
                $lastestAddImg = $lastestAddImgQuery->fetchall(PDO::FETCH_ASSOC);

                foreach ($lastestAddImg as $row_lastestAddImg) {
                    if ($row_lastestAddImg['room_id'] === $PastResa['room_id']) {

                        echo '<div class="lodging-d-flex"><div class="lodging-img-lg col-md-4 mt-3 col-lg-6"><img src="' . $row_lastestAddImg['img'] . '" alt="" class="d-block w-100 h-100"></div>';
                    }
                }
            ?>
                <div class="lodging-img-lg lodging-d-flex-div col-md-4 mt-3 col-lg-6 pl">
                    <div>
                        <div><?php echo "Du " .  $startDate->format('d/m/Y') . " au " . $endDate->format('d/m/Y') . " - " . $PastResa['city'] ?></div>
                        <div>
                            <h2><?php echo $PastResa['title'] ?></h2>
                        </div>
                        <div><small><?php echo "Prix/nuit : " . $PastResa['price'] . "€ - Chambre(s) : " . $PastResa['nb_bedroom'] . " - Sdb(s) : " . $PastResa['nb_bathroom'] ?></small></div>
                        <small>Equipement(s):
                            <?php

                            if ($PastResa['has_tv'] === 1) {
                                echo " TV ";
                            }
                            if ($PastResa['has_wifi'] === 1) {
                                echo " Wifi ";
                            }
                            if ($PastResa['has_kitchen'] === 1) {
                                echo " Cuisine ";
                            }
                            if ($PastResa['has_aircon'] === 1) {
                                echo " Climatisation ";
                            }
                            ?>
                            <br>
                        </small>
                    </div>
                    <span>Prix: <?php echo $PastResa['total_price'] . "€" ?> </span>
                </div>
               
            <?php
            }
            ?>
        </div>
        <hr>
    </div>






    <?php
    require_once 'footer.php';
    ?>