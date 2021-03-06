<?php
$titleWeb = "DonkeyStay";
require_once "searchBar.php";

if (isset($_POST['search'])) {

    if (empty($_POST['request']) && empty($_POST['startDate']) && empty($_POST['endDate'])) {
        echo "Veuillez remplir au moins 1 champs";
    } else {
?>
        <section>
            <div>
                <div class="container">
                    <h2 class="h2-index">Votre recherche</h2>
                    <div class="row">

                        <?php
                        $sql = "SELECT room.*,rname,nb_traveler FROM room INNER JOIN roomtype ON roomtype.id = room.roomtype_id INNER JOIN capacity ON capacity.id = room.capacity_id WHERE ";
                        $sqlCity = "city LIKE :cityRequest";
                        $sqlDate = "start_dispo <= :startDate AND end_dispo >= :endDate";
                        $sqlCapacity = " AND capacity_id >= :capacity";

                        $cityRequest = $_POST['request'];
                        $startDate = $_POST['startDate'];
                        $endDate = $_POST['endDate'];
                        $capacity = $_POST['capacity'];

                        if (!empty($_POST['request']) && !empty($_POST['startDate']) && !empty($_POST['endDate'])) {
                            $sql .= $sqlCity . ' AND ' . $sqlDate . $sqlCapacity;
                        } elseif (!empty($_POST['startDate']) && !empty($_POST['endDate']) && empty($_POST['request'])) {
                            $sql .= $sqlDate . $sqlCapacity;
                        } elseif (!empty($_POST['request'])) {
                            $sql .= $sqlCity . $sqlCapacity;
                        }

                        $querySearch = $dbh->prepare($sql);

                        if (!empty($_POST['request']) && !empty($_POST['startDate']) && !empty($_POST['endDate'])) {
                            $querySearch->bindValue(':cityRequest', "%" . $cityRequest . "%", PDO::PARAM_STR);
                            $querySearch->bindValue(':startDate', $startDate, PDO::PARAM_STR);
                            $querySearch->bindValue(':endDate', $endDate, PDO::PARAM_STR);
                            $querySearch->bindValue(':capacity', $capacity, PDO::PARAM_STR);
                        } elseif (!empty($_POST['startDate']) && !empty($_POST['endDate']) && empty($_POST['request'])) {
                            $querySearch->bindValue(':startDate', $startDate, PDO::PARAM_STR);
                            $querySearch->bindValue(':endDate', $endDate, PDO::PARAM_STR);
                            $querySearch->bindValue(':capacity', $capacity, PDO::PARAM_STR);
                        } elseif (!empty($_POST['request'])) {
                            $querySearch->bindValue(':cityRequest', "%" . $cityRequest . "%", PDO::PARAM_STR);
                            $querySearch->bindValue(':capacity', $capacity, PDO::PARAM_STR);
                        }

                        $querySearch->execute();
                        $rooms = $querySearch->fetchAll(PDO::FETCH_ASSOC);

                        if ($querySearch->rowCount() === 0) {
                            echo "<p>Nous n'avons malheureusement pas trouv?? d'h??bergement correspondant ?? votre recherche</p>";
                        }

                        foreach ($rooms as $room) {

                            $startDateSearch = new DateTime($room['start_dispo']);
                            $endDateSearch = new DateTime($room['end_dispo']);
                            
                            $ImgSearchQuery = $dbh->query('SELECT * FROM image WHERE room_id =' . $room['id'] . ' LIMIT 1');
                            $ImgSearchList = $ImgSearchQuery->fetchall(PDO::FETCH_ASSOC);
                        ?>

                            <div class="col-lg-3 mb-3">
                                <div class="card">

                                    <?php
                                    foreach ($ImgSearchList as $ImgSearch) {
                                        if ($ImgSearch['room_id'] === $room['id']) {

                                            echo '<img src="' . $ImgSearch['img'] . '" alt="" class="card-img-top">';
                                        }
                                    }
                                    ?>

                                    <small><?php echo $room['rname'] . ' - ' . $room['nb_traveler'] . ' - ' . $room['city'] ?></small>
                                    <div id="card">
                                        <h3 class="card-title"><?php echo $room['title'] ?></h3>
                                        <p class="card-text"><?php echo "Du : <br>" . $startDateSearch->format('d/m/Y') . " au " .  $endDateSearch->format('d/m/Y') ?></p>
                                        <p class="card-text"><?php echo $room['price'] . '??? / nuit' ?></p>
                                        <div class="button-submit-search-bar"><a href="lodging_info.php?id=<?php echo $room['id'] ?>" class="btn btn-secondary">Voir</a></div>

                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    }
                }
                ?>
        </section>
        <section>

            <div>
                <div class="container">
                    <h2 class="h2-index">Derniers logements ajout??s</h2>
                    <div class="row">
                        <?php

                        $lastestAddQuery = $dbh->query('SELECT room.*,rname,nb_traveler FROM room INNER JOIN roomtype ON roomtype.id = room.roomtype_id INNER JOIN capacity ON capacity.id = room.capacity_id ORDER BY id DESC LIMIT 4');

                        $lastestAdd = $lastestAddQuery->fetchall(PDO::FETCH_ASSOC);


                        foreach ($lastestAdd as $row_lastestAdd) {

                            $startDateAdd = new DateTime($row_lastestAdd['start_dispo']);
                            $endDateAdd = new DateTime($row_lastestAdd['end_dispo']);

                            $lastestAddImgQuery = $dbh->query('SELECT * FROM image WHERE room_id =' . $row_lastestAdd['id'] . ' LIMIT 1');
                            $lastestAddImg = $lastestAddImgQuery->fetchall(PDO::FETCH_ASSOC);
                        ?>

                            <div class="col-lg-3 mb-3">
                                <div class="card">

                                    <?php
                                    foreach ($lastestAddImg as $row_lastestAddImg) {
                                        if ($row_lastestAddImg['room_id'] === $row_lastestAdd['id']) {

                                            echo '<img src="' . $row_lastestAddImg['img'] . '" alt="" class="card-img-top">';
                                        }
                                    }
                                    ?>

                                    <small class="mb-2"><?php echo $row_lastestAdd['rname'] . ' - ' . $row_lastestAdd['nb_traveler'] . ' - ' . $row_lastestAdd['city'] ?></small>
                                    <div id="card">
                                        <h3 class="h3 card-title"><?php echo $row_lastestAdd['title'] ?></h3>
                                        <p class="card-text"><?php echo "Du : <br>" . $startDateAdd->format('d/m/Y') . " au " .  $endDateAdd->format('d/m/Y') ?></p>
                                        <p class="card-text"><?php echo $row_lastestAdd['price'] . '??? / nuit ' ?></p>
                                        <div class="button-submit-search-bar"><a href="lodging_info.php?id=<?php echo $row_lastestAdd['id'] ?>" class="btn btn-secondary">Voir</a></div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container-fluid container py-3 mt-4">
                <h2 class="h2-index ">Voyager avec DonkeyStay</h2>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card mb-3 border-0">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="64" height="64">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                            <div class="card-body pl-0">
                                <h3 class="h3 card-title">Assistance client 24h/24 et 7j/7</h3>
                                <p class="card-text">De jour comme de nuit, nous sommes l?? pour vous. Parlez ?? notre ??quipe d'assistance de n'importe o?? dans le monde, ?? n'importe quelle heure de la journ??e.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3 border-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24">
                                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                                <path d="M0 0h24v24H0z" fill="none" />
                            </svg>
                            <div class="card-body pl-0">
                                <h3 class="h3 card-title">Normes mondiales d'accueil</h3>
                                <p class="card-text">Tous les h??tes sont contr??l??s et doivent maintenir nos normes d'hospitalit?? pour ??tre sur DonkeyStay.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3 border-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M0 0h24v24H0z" />
                                <g fill-rule="evenodd" clip-rule="evenodd">
                                    <path d="M9 17l3-2.94c-.39-.04-.68-.06-1-.06-2.67 0-8 1.34-8 4v2h9l-3-3zm2-5c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4" />
                                    <path d="M15.47 20.5L12 17l1.4-1.41 2.07 2.08 5.13-5.17 1.4 1.41z" />
                                </g>
                            </svg>
                            <div class="card-body pl-0">
                                <h3 class="h3 card-title">H??tes 5 ??toiles</h3>
                                <p class="card-text">Des draps fra??chement lav??s aux conseils pour trouver le meilleur brunch, nos h??tes sont pleins d'hospitalit?? !</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container-fluid border-top mt-5">

            <?php
            require_once "footer.php";
            ?>