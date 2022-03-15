<?php

require_once 'pdo.php';


$stmt = $dbh->prepare('SELECT city FROM room ORDER BY city ASC');
$stmt->execute();
$result = array();
while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
    array_push($result, $row->city);
}
echo json_encode($result);
