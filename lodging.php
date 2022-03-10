<?php
require "searchBar.php";

$lodgingQuery = $dbh->query('SELECT room.*,img FROM room INNER JOIN image ON image.room_id = room.id');

$lodgings = $lodgingQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<hr>

<section>
    <h1>Mes logements</h1>
    <?php
        foreach ($lodgings as $lodging) {
            echo '<div style="display: flex;">';
                echo '<div>';
                    echo '<img src="'.$lodging['img'].'" width="300px" height="auto" alt="">';
                echo '</div>';
                echo '<div>';
                    echo '<div><span>'.$lodging['hometype_id'].': '.$lodging['roomtype_id'].' - '.$lodging['city'].'</span></div>';
                    echo '<div><h2>'.$lodging['title'].'</h2></div>';
                    echo '<div><span>'.$lodging['capacity'].' - '.$lodging['nb_bedroom'].' - '.$lodging['nb_bathroom'].'</span></div>';
                    echo '<div><span>'.$lodging['has_wifi'].' - '.$lodging['has_kitchen'].'</span></div>';
                    echo '<span><a href="modifyLodging.php?id='.$lodging['id'].'" class="bouton">Modifier</a><a href="deleteLodging.php?id='.$lodging['id'].'" class="bouton">Supprimer</a></span>';
                    echo '<span>'.'Prix/nuit: '.$lodging['price'].'€'.'</span>';
                echo '</div>';
            echo '</div>';
        }
        echo '<span><a href="form_addLodging.php?id='.$lodging['id'].'" class="bouton">+ Ajouter</a></span>';
    ?>
</section>

<style>body {background-color: lightgrey;}</style>

<hr>
<?php
require "footer.php";
?>