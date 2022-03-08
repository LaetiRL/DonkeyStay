<main>
    <section class="section section-top section-full">

        <!-- Cover -->
        <div class="bg-cover" style="background-image: url(https://images.unsplash.com/photo-1542833278-f4deb3180291?ixlib=rb-1.2.1&auto=format&fit=crop&w=1487&q=80);
                                         position: absolute;
                                         top: 0;
                                         left: 0;
                                         right: 0;
                                         bottom: 0;
                                         background-repeat: no-repeat;
                                         background-position: 50%;
                                         background-size: cover;"></div>

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