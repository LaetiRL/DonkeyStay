<?php
require_once "pdo.php";
$infoStartDate = $_POST['infoStartDate'];
$infoEndDate = $_POST['infoEndDate'];
$price = $_POST['price'];


function totalPrice($infoStartDate, $infoEndDate, $price) {
    $start = strtotime($infoStartDate);
    $end = strtotime($infoEndDate);
    $datediff = $end - $start;
    $nbDay = round($datediff / (60 * 60 * 24)); 

    $totalPrice = $price * $nbDay;

    $petOption = $_POST['petOption'];
    $cancelOption = $_POST['cancelOption'];

    
    if ($petOption) {
        $totalPrice = $totalPrice + 20;
    }
    if ($cancelOption) {
        $totalPrice = $totalPrice + 2.5;
    }
    
    
    return $totalPrice;
}

echo totalPrice($infoStartDate, $infoEndDate, $price);

