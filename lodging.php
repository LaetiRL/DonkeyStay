<?php
require "header.php";

$lodgingQuery = $dbh->query('SELECT room.*,img FROM room INNER JOIN image ON image.room_id = room.id');

$lodging = $lodgingQuery->fetchAll(PDO::FETCH_ASSOC);



?>

<hr>

<section>
    <h1>Mes logements</h1>
    <?php
        foreach ($lodging as $lodgings) {
            echo '<div style="display: flex;">';
                echo '<div>';
                    echo '<img src="'.$lodgings['img'].'" width="300px" height="auto" alt="">';
                echo '</div>';
                echo '<div>';
                    echo '<div><span>'.$lodgings['hometype_id'].': '.$lodgings['roomtype_id'].' - '.$lodgings['city'].'</span></div>';
                    echo '<div><h2>'.$lodgings['title'].'</h2></div>';
                    echo '<div><span>'.$lodgings['capacity'].' - '.$lodgings['nb_bedroom'].' - '.$lodgings['nb_bathroom'].'</span></div>';
                    echo '<div><span>'.$lodgings['has_wifi'].' - '.$lodgings['has_kitchen'].'</span></div>';
                    echo '<span><a href="form_mod2.php?id='.$lodgings['id'].'" class="bouton">Modifier</a><a href="form_del.php?id='.$lodgings['id'].'" class="bouton">Supprimer</a></span>';
                    echo '<span>'.'Prix/nuit: '.$lodgings['price'].'€'.'</span>';
                echo '</div>';
            echo '</div>';
        }
    ?>
</section>

<div style="display: flex;"></div>

<style>body {background-color: lightgrey;}</style>

<hr>
<?php
require "footer.php";
?>