<?php
$titleWeb = "DonkeyStay";
require_once "searchBar.php";

$sql = "SELECT room.*, hometype.hname, roomtype.rname FROM room INNER JOIN hometype ON room.hometype_id = hometype.id INNER JOIN roomtype ON room.roomtype_id = roomtype.id";

if (!empty($_POST['request'])) {
    $sql .= " WHERE city LIKE :cityRequest";
}

$sql .= " ORDER BY RAND()";

$querySearch = $dbh->prepare($sql);

if (!empty($_POST['request'])) {
    $cityRequest = $_POST['request'];

    $querySearch->bindValue(':cityRequest', "%" . $cityRequest . "%", PDO::PARAM_STR);
}

$querySearch->execute();
$rooms = $querySearch->fetchAll(PDO::FETCH_ASSOC);
?>
    <?php foreach ($rooms as $room) : ?>
        <h3><?php echo $room['hname'] ?></h3>
        <p><?php echo $room['rname'] ?></p>
        <h4><?php echo $room['description'] ?></h4>
    <?php endforeach; ?>

    <section>
        <!-- <?php
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
                        echo '<span><a href="form_mod2.php?id='.$lodging['id'].'" class="bouton">Modifier</a><a href="form_del.php?id='.$lodging['id'].'" class="bouton">Supprimer</a></span>';
                        echo '<span>'.'Prix/nuit: '.$lodging['price'].'€'.'</span>';
                    echo '</div>';
                echo '</div>';
            }
            echo '<span><a href="form_addLodging.php?id='.$lodging['id'].'" class="bouton">+ Ajouter</a></span>';
        ?> -->
        
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <img src="https://images.unsplash.com/photo-1477862096227-3a1bb3b08330?ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=60" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Sunset</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ut eum similique repellat a laborum, rerum voluptates ipsam eos quo tempore iusto dolore modi dolorum in pariatur. Incidunt repellendus praesentium quae!</p>
                                <a href="" class="btn btn-outline-success btn-sm">Read More</a>
                                <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <img src="https://images.unsplash.com/photo-1516214104703-d870798883c5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=700&q=60" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Sunset</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ut eum similique repellat a laborum, rerum voluptates ipsam eos quo tempore iusto dolore modi dolorum in pariatur. Incidunt repellendus praesentium quae!</p>
                                <a href="" class="btn btn-outline-success btn-sm">Read More</a>
                                <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <img src="https://images.unsplash.com/photo-1477862096227-3a1bb3b08330?ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=60" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Sunset</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ut eum similique repellat a laborum, rerum voluptates ipsam eos quo tempore iusto dolore modi dolorum in pariatur. Incidunt repellendus praesentium quae!</p>
                                <a href="" class="btn btn-outline-success btn-sm">Read More</a>
                                <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- -->
        <div class="container-fluid container">
            <h2 class="h3">Derniers logements ajoutés</h2>
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card mb-3 border-0">
                        <img src="https://images.unsplash.com/photo-1556912172-45b7abe8b7e1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" class="card-img-top br0" alt="...">
                        <p class="small text-uppercase pb-0">Entire house, Joshua Tree</p>
                        <div class="card-body p-0">
                            <h5 class="card-title">The Joshua Tree House</h5>
                            <p class="card-text m-0">$290/night</p>
                            <p class="small m-0 text-info">&#9733;&#9733;&#9733;&#9733;&#9733;<span class="text-secondary"> 465, Superhost</span></p>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-3 border-0">
                        <img src="https://images.unsplash.com/photo-1489171078254-c3365d6e359f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1489&q=80" class="card-img-top br0" alt="...">
                        <p class="small text-uppercase pb-0">Dome house, Aptos</p>
                        <div class="card-body p-0">
                            <h5 class="card-title">Mushroom Dome Cabin: #1 on airbnb in the world</h5>
                            <p class="card-text m-0">$130/night</p>
                            <p class="small m-0 text-info">&#9733;&#9733;&#9733;&#9733;&#9733;<span class="text-secondary"> 1383, Superhost</span></p>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-3 border-0">
                        <img src="https://images.unsplash.com/photo-1505577058444-a3dab90d4253?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" class="card-img-top br0" alt="...">
                        <p class="small text-uppercase pb-0">Earth House, Orondo</p>
                        <div class="card-body p-0">
                            <h5 class="card-title">Underground Hygge</h5>
                            <p class="card-text m-0">$150/night</p>
                            <p class="small m-0 text-info">&#9733;&#9733;&#9733;&#9733;&#9733;<span class="text-secondary"> 544, Superhost</span></p>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-3 border-0">
                        <img src="https://images.unsplash.com/photo-1505576391880-b3f9d713dc4f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80" class="card-img-top br0" alt="...">
                        <p class="small text-uppercase pb-0">Entire House, Pioneertown</p>
                        <div class="card-body p-0">
                            <h5 class="card-title">Off-grid itHouse</h5>
                            <p class="card-text m-0">$400/night</p>
                            <p class="small m-0 text-info">&#9733;&#9733;&#9733;&#9733;&#9733;<span class="text-secondary"> 254</span></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid container py-3 mt-4">
            <h2 class="h3">Voyager avec DonkeyStay</h2>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card mb-3 border-0">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="64" height="64">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                        <div class="card-body pl-0">
                            <h5 class="card-title">24/7 customer support</h5>
                            <p class="card-text">Day or night, we’re here for you. Talk to our support team from anywhere in the world, any hour of day.</p>
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
                            <h5 class="card-title">Global hospitality standards</h5>
                            <p class="card-text">Guests review their hosts after each stay. All hosts must maintain a minimum rating and our hospitality standards to be on Airbnb.</p>
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
                            <h5 class="card-title">5-star hosts</h5>
                            <p class="card-text">From fresh-pressed sheets to tips on where to get the best brunch, our hosts are full of local hospitality.</p>
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