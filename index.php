<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
        @media(min-width: 768px) {
            section {
                padding-top: 13.3125rem;
            }

            section {
                padding-bottom: 7.5rem;
            }
        }

        .br0,
        .gj-datepicker-bootstrap [role=right-icon] button,
        .form-control {
            border-radius: 0 !important
        }

        .card-img-top {
            max-height: 160px;
            min-height: 160px;
            object-fit: cover
        }
    </style>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container-fluid" style="height:100vh">
        <nav class="bg-primaryX text-lightX navbar navbar-expand-xl navbar-dark  navbar-togglable  fixed-top">

            <div class="container">

                <!-- Brand -->
                <a class="navbar-brand" href="index.html">
                    Airbnb
                </a>

                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="navbarCollapse">

                    <!-- Links -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active mx-4">
                            <a class="nav-link" href="#">Become a host</a>
                        </li>
                        <li class="nav-item mx-4">
                            <a class="nav-link" href="#">Help</a>
                        </li>
                        <li class="nav-item mx-4">
                            <a class="nav-link" href="#">Sign up</a>
                        </li>
                        <li class="nav-item mx-4">
                            <a class="nav-link" href="#">Login</a>
                        </li>
                    </ul>


                </div> <!-- / .navbar-collapse -->

            </div> <!-- / .container -->
        </nav>

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
                        <div class="card-body">
                            <h1 class="h3 mb-3">Book homes, hotels, and more on Airbnb</h1>
                            <form>
                                <div class="form-group">
                                    <div class="row px-3">
                                        <label class="mb-0" for="locationInput mb-0 mt-5">WHERE</label>
                                        <input type="email" class="form-control w-100 br0" id="locationInput" aria-describedby="locationInputHelp" placeholder="Anywhere">
                                        <small id="locationInputHelp" class="form-text text-muted sr-only">Please type in your desired destination.</small>
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
                            </form>

                            <a href="#" class="btn btn-danger btn-block">Search</a>
                        </div>
                    </div>
                    <div class="card my-4 p-2 small border-0">
                        <div class="row no-gutters">
                            <div class="col-md-7 d-flex align-items-center">
                                <p class="my-0 px-3">Earn up to <strong>$5530/month</strong> hosting your place in Rome</p>
                            </div>
                            <div class="col-md-5 border-left border-secondary">
                                <div class="card-body">
                                    <p class="card-text">Become a host <span>&gt;</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid container py-3 mt-4">
        <h2 class="h3">What guests are saying about homes in the United States</h2>
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card mb-3 border-0">
                    <img src="https://images.unsplash.com/photo-1533654793924-4fc4949fb71e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1351&q=80" class="card-img-top rounded" alt="...">
                    <div class="card-body pl-0">
                        <h5 class="card-title text-info">&#9733; &#9733; &#9733; &#9733; &#9733;</h5>
                        <p class="card-text">My mom and I stayed in the Silver Cloud during our time in Napa and absolutely loved it, and would've loved to stay longer. It's in a sweet, ...</p>
                        <div class="">
                            <div class="d-flex">
                                <img src="https://a0.muscache.com/im/pictures/660e2273-b37b-4f50-917e-369e7bc3f665.jpg?aki_policy=large" class="ml-0 mr-2 img-fluidX rounded-circle w-25 mb-2" alt="...">
                                <div class="d-flex flex-column">
                                    <h5 class="mt-0 mb-1">Sara</h5>
                                    <p>United States</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-3 border-0">
                    <img src="https://images.unsplash.com/photo-1520908695049-da13395b27a6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1225&q=80" class="card-img-top rounded" alt="...">
                    <div class="card-body pl-0">
                        <h5 class="card-title text-info">&#9733; &#9733; &#9733; &#9733; &#9733;</h5>
                        <p class="card-text">Great place to stay. Very clean, affordable, and good location.</p>
                        <div class="">
                            <div class="d-flex">
                                <img src="https://a0.muscache.com/im/users/6353572/profile_pic/1405804572/original.jpg?aki_policy=large" class="ml-0 mr-2 img-fluidX rounded-circle w-25 mb-2" alt="...">
                                <div class="d-flex flex-column">
                                    <h5 class="mt-0 mb-1">Adam</h5>
                                    <p>United States</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-3 border-0">
                    <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" class="card-img-top rounded" alt="...">
                    <div class="card-body pl-0">
                        <h5 class="card-title text-info">&#9733; &#9733; &#9733; &#9733; &#9733;</h5>
                        <p class="card-text">Kathryn is delightful and so is her home. Would love to come back. Thank you for everything!</p>
                        <div class="">
                            <div class="d-flex">
                                <img src="https://a0.muscache.com/im/pictures/c5c57a11-28ff-409b-a64d-370410dd9928.jpg?aki_policy=large" class="ml-0 mr-2 img-fluidX rounded-circle w-25 mb-2" alt="...">
                                <div class="d-flex flex-column">
                                    <h5 class="mt-0 mb-1">Alexis</h5>
                                    <p>United States</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid container py-3 mt-4">
        <h2 class="h3">Travelling with AirBnB</h2>
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card mb-3 border-0">
                    <svg style="fill:#60B6B5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="64" height="64">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                    <div class="card-body pl-0">
                        <h5 class="card-title">24/7 customer support</h5>
                        <p class="card-text">Day or night, we’re here for you. Talk to our support team from anywhere in the world, any hour of day.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-3 border-0">
                    <svg style="fill:#60B6B5" xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24">
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                        <path d="M0 0h24v24H0z" fill="none" />
                    </svg>
                    <div class="card-body pl-0">
                        <h5 class="card-title">Global hospitality standards</h5>
                        <p class="card-text">Guests review their hosts after each stay. All hosts must maintain a minimum rating and our hospitality standards to be on Airbnb.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-3 border-0">
                    <svg style="fill:#60B6B5" xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24">
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
    <div class="container-fluid container">
        <h2 class="h3">Just booked in the United States</h2>
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
        <div class="row mt-2 mb-5">
            <button class="btn text-info btn-link">
                <span class="h6">Show all(22,000+) &gt;</span>
            </button>
        </div>
    </div>
    <div class="container-fluid container">
        <div class="container pl-0">
            <div class="row">
                <div class="col-12 pl-0 mb-5">
                    <h2 class="h3  mt-0 mb-2">When are you travelling?</h2>
                    <p class="mt-0 ml-0 mb-2">Add dates for updated pricing and availability.</p>
                    <button class="btn btn-lg btn-success">Add dates</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid border-top mt-5">
        <footer class="container pt-4 my-md-5 pt-md-5">
            <div class="row">
                <div class="col-6 col-md">
                    <h5 class="h6">AirBnB Clone</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Careers</a></li>
                        <li><a class="text-muted" href="#">News</a></li>
                        <li><a class="text-muted" href="#">Policies</a></li>
                        <li><a class="text-muted" href="#">Help</a></li>
                        <li><a class="text-muted" href="#">Diversity &amp; Belonging</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5 class="h6">Discover</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Trust &amp; Safety</a></li>
                        <li><a class="text-muted" href="#">Credit voyage</a></li>
                        <li><a class="text-muted" href="#">Gift cards</a></li>
                        <li><a class="text-muted" href="#">Airbnb Citizen</a></li>
                        <li><a class="text-muted" href="#">Business Travel</a></li>
                        <li><a class="text-muted" href="#">Things to Do<span>&nbsp;</span><span class="badge badge-success">New</span></a></li>
                        <li><a class="text-muted" href="#">Airbnbmag</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5 class="h6">Hosting</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Why Host</a></li>
                        <li><a class="text-muted" href="#">Hospitality</a></li>
                        <li><a class="text-muted" href="#">Responsible Hosting</a></li>
                        <li><a class="text-muted" href="#">Community Center</a></li>
                        <li><a class="text-muted" href="#">Host an Experience<span>&nbsp;</span><span class="badge badge-success">New</span></a></li>
                        <li><a class="text-muted" href="#">Open homes</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5 class="h6 sr-only">Socials</h5>
                    <div class="d-flex flex-row">
                        <span class="mr-3">
                            <svg width="18" height="18" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <title>Facebook icon</title>
                                <path d="M23.9981 11.9991C23.9981 5.37216 18.626 0 11.9991 0C5.37216 0 0 5.37216 0 11.9991C0 17.9882 4.38789 22.9522 10.1242 23.8524V15.4676H7.07758V11.9991H10.1242V9.35553C10.1242 6.34826 11.9156 4.68714 14.6564 4.68714C15.9692 4.68714 17.3424 4.92149 17.3424 4.92149V7.87439H15.8294C14.3388 7.87439 13.8739 8.79933 13.8739 9.74824V11.9991H17.2018L16.6698 15.4676H13.8739V23.8524C19.6103 22.9522 23.9981 17.9882 23.9981 11.9991Z" />
                            </svg>
                        </span>
                        <span class="mr-3">
                            <svg width="18" height="18" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <title>Twitter icon</title>
                                <path d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555-2.005.959-3.127 1.184-.896-.959-2.173-1.559-3.591-1.559-2.717 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124C7.691 8.094 4.066 6.13 1.64 3.161c-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.189 1.394 4.768 2.209 7.557 2.209 9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63.961-.689 1.8-1.56 2.46-2.548l-.047-.02z" />
                            </svg>
                        </span>
                        <span class="mr-3">
                            <svg width="18" height="18" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <title>Instagram icon</title>
                                <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z" />
                            </svg>
                        </span>
                    </div>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Team</a></li>
                        <li><a class="text-muted" href="#">Locations</a></li>
                        <li><a class="text-muted" href="#">Privacy</a></li>
                        <li><a class="text-muted" href="#">Terms</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>

    <!-- Optional JavaScript -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        $('#startDate').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            minDate: today,
            maxDate: function() {
                return $('#endDate').val();
            }
        });
        $('#endDate').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            minDate: function() {
                return $('#startDate').val();
            }
        });
    </script>
</body>

</html>