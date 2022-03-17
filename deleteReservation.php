<?php
require_once 'header.php';
require_once '_secured.php';
$resa_id = $_GET['id'];

$queryDeleteResa = $dbh->prepare("DELETE FROM booking WHERE id =:resa_id");

$queryDeleteResa->bindValue(":resa_id", $resa_id, PDO::PARAM_INT);

$queryDeleteResa->execute();

echo "<script type='text/javascript'>document.location.replace('reservation.php');</script>";

?>
