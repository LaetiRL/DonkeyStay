<?php

$titleWeb = "Mes logements";
require_once 'header.php';
require_once '_secured.php';
$user_id = $_SESSION['user_id'];

$lodgingQuery = $dbh->prepare("SELECT room.*,rname,hname,nb_traveler FROM room INNER JOIN roomtype ON roomtype.id = room.roomtype_id INNER JOIN hometype ON hometype.id = room.hometype_id INNER JOIN capacity ON capacity.id = room.capacity_id WHERE room.user_id =:userId");

$lodgingQuery->bindValue(":userId", $user_id, PDO::PARAM_INT);
$lodgingQuery->execute();

$lodgings = $lodgingQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="logements">
    <h1 class="mt-5">Mes logements</h1>
    <div class="d-flex">
        <div class="mx-1">
            <?php
            foreach ($lodgings as $lodging) {

                $lastestAddImgQuery = $dbh->query('SELECT * FROM image WHERE room_id =' . $lodging['id'] . ' LIMIT 1');
                $lastestAddImg = $lastestAddImgQuery->fetchall(PDO::FETCH_ASSOC);

                foreach ($lastestAddImg as $row_lastestAddImg) {
                    if ($row_lastestAddImg['room_id'] === $lodging['id']) {

                        echo '<img src="' . $row_lastestAddImg['img'] . '" alt="" class="card-img-top">';
                    }
                }
            ?>
                <div>
                    <div><span><?php echo $lodging['hname'] . " - " . $lodging['rname'] . " - " . $lodging['city'] ?></span></div>
                    <div>
                        <h2><?php echo $lodging['title'] ?></h2>
                    </div>
                    <div class="equipments"><small><?php echo $lodging['nb_traveler'] . " - Chambre(s): " . $lodging['nb_bedroom'] . " - Sdb(s): " . $lodging['nb_bathroom'] ?></small></div>
                    <small>Equipement(s):
                        <?php

                        if ($lodging['has_tv'] === 1) {
                            echo " TV ";
                        }
                        if ($lodging['has_wifi'] === 1) {
                            echo " Wifi ";
                        }
                        if ($lodging['has_kitchen'] === 1) {
                            echo " Cuisine ";
                        }
                        if ($lodging['has_aircon'] === 1) {
                            echo " Climatisation ";
                        }
                        ?>
                        <br>
                        <span style="padding-bottom: 50px;"><a href="modifyLodging.php?id=<?php echo $lodging['id'] ?>"><button type="button" class="btn btn-secondary">Modifier</button></a></span>
                        <span><a href="deleteLodging.php?id=<?php echo $lodging['id']; ?>" onclick="return confirm('Supprimer définitivement le logement ?');"><button type="button" class="btn btn-danger">Supprimer</button></a></span>
                        <span>Prix/nuit: <?php echo $lodging['price'] . "€" ?> </span>
                    </small>
                </div>
                <hr>
            <?php
            }
            ?>
            <span><a href="addLodging.php"><button type="button" class="btn btn-primary">Ajouter un logement</button></a></span>
        </div>
    </div>
</section>

<?php
require "footer.php";
?>