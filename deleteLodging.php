<?php
require_once 'header.php';
require_once '_secured.php';

$room_id = $_GET['id'];

$queryDeleteImg = $dbh->prepare("DELETE FROM image WHERE room_id =:room_id");

$queryDeleteImg->bindValue(":room_id", $room_id, PDO::PARAM_INT);

$queryDeleteImg->execute();

$queryDeleteRoom = $dbh->prepare("DELETE FROM room WHERE id =:room_id");

$queryDeleteRoom->bindValue(":room_id", $room_id, PDO::PARAM_INT);

$queryDeleteRoom->execute();

echo "<script type='text/javascript'>document.location.replace('lodging.php');</script>";

?>