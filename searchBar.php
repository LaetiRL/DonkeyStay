<?php
require_once 'header.php';
?>

<main>
    <section>

        <!-- Carousel -->
        <div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="5000">
                    <img src="/img/caroussel/louvre_paris.jpg" class="d-block w-100" alt="pyramide du Louvre">
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                    <img src="/img/caroussel/marseille_calanque.jpg" class="d-block w-100" alt="calanque de Marseille">
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                    <img src="/img/caroussel/mont_saint_michel.jpg" class="d-block w-100" alt="Mont Saint-Michel">
                </div>
            </div>
        </div>

        <!-- Overlay -->
        <div class="bg-overlay"></div>

        <!-- Triangles -->
        <div class="bg-triangle bg-triangle-light bg-triangle-bottom bg-triangle-left"></div>
        <div class="bg-triangle bg-triangle-light bg-triangle-bottom bg-triangle-right"></div>

        <!-- Content -->
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-8 col-lg-7">


                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->

        <!-- SearchBar -->
        <div class="container search-bar">
            <div class="row">
                <div class="col-sm-5">
                    <div class="card border-0">
                        <h1 class="h3 mb-3">Rechercher votre prochain voyage avec DonkeyStay</h1>
                        <form method="POST">
                            <div class="row">
                                <div class="form-group">
                                    <label for="request">Ville</label>
                                    <input type="text" class="form-control w-100 br0" id="request" name="request" aria-describedby="locationInputHelp" placeholder="Ville Française">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <label for="startDate">Départ:</label><br>
                                    <input type="date" id="startDate" />
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <label for="endDate">Retour:</label><br>
                                    <input type="date" id="endDate" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Voyageurs</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <?php
                                        $capacityQuery = $dbh->query('SELECT * FROM capacity ORDER BY id');
                                        $capacity = $capacityQuery->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($capacity as $row_capacity) {
                                            echo '<option value="' . $row_capacity['id'] . '">' . $row_capacity['nb_traveler'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-danger btn-block" type="submit" name="search">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>