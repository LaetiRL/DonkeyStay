<?php

$titleWeb = "Mes Réservations";
require 'searchBar.php';
require_once '_secured.php';
$user_id = $_SESSION['user_id'];


$resaQueryFutur = "SELECT room.*, booking.* FROM booking INNER JOIN room ON booking.room_id = room.id WHERE booking.user_id =:userId AND end_date > NOW() ORDER BY start_date";

$stmFutur = $dbh->prepare($resaQueryFutur);
$stmFutur->bindValue(":userId", $user_id, PDO::PARAM_INT);
$stmFutur->execute();
$futurResas = $stmFutur->fetchAll(PDO::FETCH_ASSOC);
?>

<section>
    <h1 class="h2-index mb-4">Mes Réservations</h1>
    <div class="d-flex j-c">
        <a href="/reservation.php"><button type="button" class="btn btn-secondary mx-2">À venir</button></a>
        <a href="/historical.php"><button type="button" class="btn btn-secondary mx-2">Historique</button></a>
    </div>
    <h2 class="mt-5 h2-index">Mes prochaines réservations</h2>
    <div class="d-flex">
        <div class="mx-1">
            <?php

            foreach ($futurResas as $futurResa) {

                $startDate = new DateTime($futurResa['start_date']);
                $endDate = new DateTime($futurResa['end_date']);

                $lastestAddImgQuery = $dbh->query('SELECT * FROM image WHERE room_id =' . $futurResa['room_id'] . ' LIMIT 1');
                $lastestAddImg = $lastestAddImgQuery->fetchall(PDO::FETCH_ASSOC);

                foreach ($lastestAddImg as $row_lastestAddImg) {
                    if ($row_lastestAddImg['room_id'] === $futurResa['room_id']) {

                        echo '<img src="' . $row_lastestAddImg['img'] . '" alt="" class="card-img-top">';
                    }
                }
            ?>
                <div>
                    <div><?php echo "Du " .  $startDate->format('d/m/Y') . " au " . $endDate->format('d/m/Y') . " - " . $futurResa['city'] ?></div>
                    <div>
                        <h2><?php echo $futurResa['title'] ?></h2>
                    </div>
                    <div><small><?php echo "Prix/nuit : " . $futurResa['price'] . "€ - Chambre(s) : " . $futurResa['nb_bedroom'] . " - Sdb(s) : " . $futurResa['nb_bathroom'] ?></small></div>
                    <small>Equipement(s):
                        <?php

                        if ($futurResa['has_tv'] === 1) {
                            echo " TV ";
                        }
                        if ($futurResa['has_wifi'] === 1) {
                            echo " Wifi ";
                        }
                        if ($futurResa['has_kitchen'] === 1) {
                            echo " Cuisine ";
                        }
                        if ($futurResa['has_aircon'] === 1) {
                            echo " Climatisation ";
                        }
                        ?>
                        <br>
                        <span style="padding-bottom: 50px;"><a href="modifyReservation.php?id=<?php echo $futurResa['id']; ?>"><button type="button" class="btn btn-secondary">Modifier</button></a></span>
                        <span><a href="deleteReservation.php?id=<?php echo $futurResa['id']; ?>" onclick="return confirm('Supprimer définitivement la réservation ?');"><button type="button" class="btn btn-danger">Supprimer</button></a></span>
                        <span>Prix: <?php echo $futurResa['total_price'] . "€" ?> </span>
                    </small>
                </div>
                <hr>
            <?php
            }
            ?>
        </div>
    </div>
</section>




<?php
require_once 'footer.php';
?>