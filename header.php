<?php
require_once 'pdo.php';

$currentDate = date('Y-m-d');
$minimumDepartureDate = date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days'));

if (isset($_POST['validate'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $userEmail = $_POST['email'];
        $userPassword = $_POST['password'];

        $sql = "SELECT * FROM user WHERE email = :userEmail AND password = :userPassword";
        $queryUser = $dbh->prepare($sql);

        $queryUser->bindValue(':userEmail', $userEmail, PDO::PARAM_STR);
        $queryUser->bindValue(':userPassword', $userPassword, PDO::PARAM_STR);

        $queryUser->execute();
        $userArray = $queryUser->fetchAll(PDO::FETCH_OBJ);

        foreach ($userArray as $user) :
            $_SESSION['user_id'] = $user->id;
            $_SESSION['name'] = $user->firstname;
        endforeach;
    } else {
        $_SESSION['name'] = '';
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--FontAwesome and Bootstrap CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link href="/css/style.css" rel="stylesheet">
    <title><?php echo $titleWeb ?></title>

    <!-- AJAX and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- jquery -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

</head>

<body>
    <header>
        <nav class="bg-primaryX text-lightX navbar navbar-expand-xl navbar-dark  navbar-togglable  fixed-top">

            <div class="container">

                <!-- Brand -->
                <a class="navbar-brand" href="index.php">
                    DonkeyStay
                </a>
                <!-- Connection user -->
                <a class="navbar-brand disabled active"><?php if (isset($_SESSION['name']) && !empty($_SESSION['name'])) {
                                                            echo 'Hi ' . $_SESSION['name'] . ' !';
                                                        } else {
                                                            echo 'Hi Traveler !';
                                                        }; ?></a>

                <!-- Toggler -->
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Collapse -->
                <div class="collapse navbar-collapse  " id="navbarCollapse">


                    <!-- Links -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item ms-auto">

                            <!-- Link once connected my lodging and my travel -->
                            <?php if (isset($_SESSION['name']) && !empty($_SESSION['name'])) {
                                echo "<a class='nav-link active ' href='/lodging.php'>Mes logements</a>";
                            } ?>
                        </li>
                        <li class="nav-item ms-auto">
                            <?php if (isset($_SESSION['name']) && !empty($_SESSION['name'])) {
                                echo "<a class='nav-link active' href='/reservation.php'>Mes R??servations</a>";
                            } ?>
                        </li>
                        <li class="nav-item ms-auto">
                            <?php if (isset($_SESSION['name']) && !empty($_SESSION['name'])) {
                                echo "<a class='nav-link active ' href='/logout.php'>Se d??connecter</a>";
                            } else {
                                echo "<button type='button' class='btn nav-link active' data-bs-toggle='modal' data-bs-target='#modalForm'>Se connecter</button>";
                            }  ?>
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
                                <input type="text" class="form-control" id="email" name="email" placeholder="email" />
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" />
                            </div>
                            <div class="modal-footer d-block">
                                <button type="submit" class="btn btn-primary float-end" name="validate">Connexion</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </header>