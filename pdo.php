<?php
require_once "_connec.php";
session_start();
$dbh = new PDO($dsn, $user, $password);