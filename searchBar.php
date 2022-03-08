<?php 
require_once "header.php";
?>

<main>
    <section style="padding-top: 0px;">

        <!-- Cover -->
        <div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="4000">
                    <img src="/img/caroussel/louvre_paris.jpg" class="d-block w-100" alt="pyramide du Louvre">
                </div>
                <div class="carousel-item" data-bs-interval="4000">
                    <img src="/img/caroussel/marseille_calanque.jpg" class="d-block w-100" alt="calanque de Marseille">
                </div>
                <div class="carousel-item" data-bs-interval="4000">
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

    </section>

    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <div class="card border-0">
                    <h1 class="h3 mb-3">Book homes, hotels, and more on DonkeyStay</h1>
                    <form method="POST">
                        <div class="form-group">
                            <div class="row px-3">
                                <label class="mb-0" for="locationInput mb-0 mt-5">WHERE</label>
                                <input type="text" class="form-control w-100 br0" id="request" name="request" aria-describedby="locationInputHelp" placeholder="Anywhere">
                                <small id="locationInputHelp" class="form-text text-muted sr-only color">Please type in your desired destination.</small>
                            </div>
                        </div>
                        <div class="row px-3">
                            <div class="col-sm-6 px-0">
                                Start Date: <input class="br0" id="startDate" />
                            </div>
                            <div class="col-sm-6 px-0 br0">
                                End Date: <input class="br0" id="endDate" />
                            </div>
                        </div>


                        <div class="row px-3">
                            <div class="col-sm-6 px-0 br0">
                                <div class="form-group">
                                    <label class="mb-0 mt-3" for="exampleFormControlSelect1">ADULTS</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option>1 adult</option>
                                        <option>2 adults</option>
                                        <option>3 adults</option>
                                        <option>4 adults</option>
                                        <option>5 adults</option>
                                        <option>6 adults</option>
                                        <option>7 adults</option>
                                        <option>8 adults</option>
                                        <option>9 adults</option>
                                        <option>10 adults</option>
                                        <option>11 adults</option>
                                        <option>12 adults</option>
                                        <option>13 adults</option>
                                        <option>14 adults</option>
                                        <option>15 adults</option>
                                        <option>16 adults</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 px-0 br0">
                                <div class="form-group">
                                    <label class="mb-0 mt-3" for="exampleFormControlSelect2">CHILDREN</label>
                                    <select class="form-control" id="exampleFormControlSelect2">
                                        <option>0 children</option>
                                        <option>1 child</option>
                                        <option>2 children</option>
                                        <option>3 children</option>
                                        <option>4 children</option>
                                        <option>5 children</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-danger btn-block" type="submit" name="search">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>