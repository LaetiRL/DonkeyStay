<?php
$titleWeb = "Mes logements";
require "header.php";
$user_id = $_SESSION['user_id'];

$lodgingQuery = $dbh->prepare("SELECT room.*,rname,hname,nb_traveler FROM room INNER JOIN roomtype ON roomtype.id = room.roomtype_id INNER JOIN hometype ON hometype.id = room.hometype_id INNER JOIN capacity ON capacity.id = room.capacity_id WHERE room.user_id =:userId");

$lodgingQuery->bindValue(":userId", $user_id, PDO::PARAM_INT);
$lodgingQuery->execute();

$lodgings = $lodgingQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<section>
    <h1 class="mt-5">Mes logements</h1>
    <?php
    foreach ($lodgings as $lodging) {

        echo '<div class="container">';
        echo '<div class="d-flex">';
        echo '<div class="mx-1">';
        $lastestAddImgQuery = $dbh->query('SELECT * FROM image WHERE room_id =' . $lodging['id'] . ' LIMIT 1');
        $lastestAddImg = $lastestAddImgQuery->fetchall(PDO::FETCH_ASSOC);

        foreach ($lastestAddImg as $row_lastestAddImg) {
            if ($row_lastestAddImg['room_id'] === $lodging['id']) {

                echo '<img src="' . $row_lastestAddImg['img'] . '" alt="" class="card-img-top">';
            }
        }
    ?>

        </div>
        <div>
            <div><span><?php echo $lodging['hname'] . " - " . $lodging['rname'] . " - " . $lodging['city'] ?></span></div>
            <div>
                <h2><?php echo $lodging['title'] ?></h2>
            </div>
            <div><small><?php echo $lodging['nb_traveler'] . " - Chambre(s): " . $lodging['nb_bedroom'] . " - Sdb(s): " . $lodging['nb_bathroom'] ?></small></div>
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
                <span><button type="button" class="btn btn-secondary"><a href="modifyLodging.php?id=<?php echo $lodging['id'] ?>">Modifier</a></button>
                    <a href="deleteLodging.php?id=<?php echo $lodging['id']; ?>" onclick="return confirm('Etes vous sur ?');">Supprimer</a></span>
                <span>Prix/nuit: <?php echo $lodging['price'] . "€" ?> </span>
        </div>
        </div>
        <hr>
        </div>

    <?php
    }
    ?>
    <span><a href="addLodging.php" class="bouton">+ Ajouter</a></span>

</section>

<?php
require "footer.php";
?>