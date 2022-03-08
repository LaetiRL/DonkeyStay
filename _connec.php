<?php

session_start();

/* Connexion à une base MySQL avec l'invocation de pilote */
$dsn = 'mysql:dbname=DonkeyStay;localhost';
$user = 'root';
$password = '';

$dbh = new PDO($dsn, $user, $password);