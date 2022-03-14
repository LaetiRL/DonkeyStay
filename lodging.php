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
                    $lastestAddImgQuery = $dbh->query('SELECT * FROM image WHERE room_id ='.$lodging['id'].' LIMIT 1');
                    $lastestAddImg = $lastestAddImgQuery->fetchall(PDO::FETCH_ASSOC);

                    foreach ($lastestAddImg as $row_lastestAddImg) {
                        if ($row_lastestAddImg['room_id'] === $lodging['id'] ) {
                            
                            echo '<img src="'.$row_lastestAddImg['img'].'" alt="" class="card-img-top">';
                        } 
                    }
                    
                echo '</div>';
                echo '<div>';
                    echo '<div><span>' . $lodging['hname'] . ': ' . $lodging['rname'] . ' - ' . $lodging['city'] . '</span></div>';
                    echo '<div><h2>' . $lodging['title'] . '</h2></div>';
                    echo '<div><small>' . $lodging['nb_traveler'] . ' - Chambre(s): ' . $lodging['nb_bedroom'] . ' - Sdb(s): ' . $lodging['nb_bathroom'] . '</small></div>';
                    echo '<small>Equipement(s):'; 
                        
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
                        
                    echo '</small><br>';
                    echo '<span><button type="button" class="btn btn-secondary"><a href="modifyLodging.php?id=' . $lodging['id'] . '">Modifier</a></button><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Supprimer
                    </button></span>';
                    echo '<span>' . 'Prix/nuit: ' . $lodging['price'] . '€' . '</span>';
                echo '</div>';
            echo '</div>';
            echo '<hr>';
        echo '</div>';
        

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

<?php
require "footer.php";
?>