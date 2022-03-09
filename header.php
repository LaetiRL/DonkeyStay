<?php
require_once "pdo.php";
if (isset($_POST['validate'])) {
    if (isset($_POST['email'])) {
        $_SESSION['email'] = $_POST['email'];
    } else {
        $_SESSION['email'] = '';
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="/css/style.css" rel="stylesheet">

    <title><?php echo $titleWeb ?></title>

</head>

<body>
    <header>
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

                            <button type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#modalForm">
                                Se connecter
                            </button>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout.php">Se déconnecter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled active"><?php if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
                                                                    echo 'Hi ' . $_SESSION['email'] . ' !';
                                                                } else {
                                                                    echo 'Hi Traveler !';
                                                                }; ?> </a>

                        </li>
                    </ul>
                </div> <!-- / .navbar-collapse -->
            </div> <!-- / .container -->
        </nav>

        <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Se connecter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="email" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe" />
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                            <div class="modal-footer d-block">
                                <p class="float-start">Not yet account <a href="#">Sign Up</a></p>
                                <button type="submit" class="btn btn-warning float-end" name="validate">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </header>