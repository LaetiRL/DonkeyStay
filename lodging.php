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
        

        echo '<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Supprimer un logement</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            Si vous confirmez, votre logement sera definitivement effacé
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">X Annuler</button>
            <button type="button" class="btn btn-secondary"><a href="deleteLodging.php?id=' . $lodging['id'] . '">&#x2713; Confirmer</a></button>
          </div>
            </div>
        </div>
        </div>';
    }
    echo '<span><a href="addLodging.php" class="bouton">+ Ajouter</a></span>';
    ?>
</section>


<?php
require "footer.php";
?>