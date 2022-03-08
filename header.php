<?php
require_once "_connec.php";
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title><?php echo $title ?></title>
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
    <header class="container-fluid" style="height:100vh">
        <nav class="bg-primaryX text-lightX navbar navbar-expand-xl navbar-dark  navbar-togglable  fixed-top">

            <div class="container">

                <!-- Brand -->
                <a class="navbar-brand" href="index.php">
                    DonkeyStay
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
    </header>