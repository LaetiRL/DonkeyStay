<?php
$titleWeb = "Mes logements";
require "header.php";
$user_id = $_SESSION['user_id'];

$lodgingQuery = $dbh->prepare("SELECT * FROM room WHERE room.user_id =:userId");

$lodgingQuery->bindValue(":userId", $user_id, PDO::PARAM_INT);
$lodgingQuery->execute();

$lodgings = $lodgingQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<hr>

<section>
    <h1>Mes logements</h1>
    <?php
    foreach ($lodgings as $lodging) {
        echo '<div style="display: flex;">';
            echo '<div>';
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
                <div><span><?php echo $lodging['hometype_id'] ?> : <?php echo $lodging['roomtype_id'] . " - " . $lodging['city'] ?></span></div>
                <div>
                    <h2><?php echo $lodging['title'] ?></h2>
                </div>
                <div><span><?php echo $lodging['capacity_id'] . " - " . $lodging['nb_bedroom'] . " - " . $lodging['nb_bathroom'] ?></span></div>
                <div><span><?php echo $lodging['has_wifi'] . " - " . $lodging['has_kitchen'] ?></span></div>
                <span><button type="button" class="btn btn-secondary"><a href="modifyLodging.php?id=<?php echo $lodging['id'] ?>">Modifier</a></button>
                    <a href="deleteLodging.php?id=<?php echo $lodging['id']; ?>" onclick="return confirm('Etes vous sur ?');">Supprimer</a></span>
                <span>Prix/nuit: <?php echo $lodging['price'] . "€" ?> </span>
            </div>
        </div>
    <?php
    }
    ?>
    <span><a href="addLodging.php" class="bouton">+ Ajouter</a></span>

</section>


<style>
    body {
        background-color:
            lightgrey;
    }
</style>

<hr>
<?php
require "footer.php";
?>