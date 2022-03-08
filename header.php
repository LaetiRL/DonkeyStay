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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>

<body>

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
                    <li class="nav-item active mx-6">
                        <a class="nav-link" href="#">Devenez hôte</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="#">Se connecter</a>
                    </li>
                </ul>
            </div> <!-- / .navbar-collapse -->
        </div> <!-- / .container -->
    </nav>
    </header>