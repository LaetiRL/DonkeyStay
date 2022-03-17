<?php

$titleWeb = "Mes Réservations";
require_once 'header.php';
require_once '_secured.php';
$user_id = $_SESSION['user_id'];

$resaQuery = "SELECT room.*, booking.* FROM booking INNER JOIN room ON booking.room_id = room.id WHERE booking.user_id =:userId AND end_date < NOW()";

$stmPast = $dbh->prepare($resaQuery);
$stmPast->bindValue(":userId", $user_id, PDO::PARAM_INT);
$stmPast->execute();
$PastResas = $stmPast->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="logements">
    <h1>Mes Réservations</h1>
    <a href="/reservation.php"><button type="button" class="btn btn-secondary">À venir</button></a>
    <a href="/historical.php"><button type="button" class="btn btn-primary">Historique</button></a>
    <h2 class="mt-5">Mon historique</h2>
    <?php
    foreach ($PastResas as $PastResa) {

        echo '<div class="container">';
        echo '<div class="d-flex">';
        echo '<div class="mx-1">';
        $lastestAddImgQuery = $dbh->query('SELECT * FROM image WHERE room_id =' . $PastResa['room_id'] . ' LIMIT 1');
        $lastestAddImg = $lastestAddImgQuery->fetchall(PDO::FETCH_ASSOC);

        foreach ($lastestAddImg as $row_lastestAddImg) {
            if ($row_lastestAddImg['room_id'] === $PastResa['room_id']) {

                echo '<img src="' . $row_lastestAddImg['img'] . '" alt="" class="card-img-top">';
            }
        }
    ?>
        <div>
            <div><span><?php echo $PastResa['start_date'] . " - " . $PastResa['end_date'] . " - " . $PastResa['city'] ?></span></div>
            <div><h2><?php echo $PastResa['title'] ?></h2></div>
            <div class="equipments"><small><?php echo "Prix/nuit" . $PastResa['price'] . "€ - Chambre(s): " . $PastResa['nb_bedroom'] . " - Sdb(s): " . $PastResa['nb_bathroom'] ?></small></div>
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
                <span>Prix: <?php echo $PastResa['total_price'] . "€" ?> </span>
            </small>
        </div>
        <hr>
    <?php
    }
    ?>






<?php
require_once 'footer.php';
?>