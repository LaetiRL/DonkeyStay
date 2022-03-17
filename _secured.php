<?php

if(!isset($_SESSION['name'])) {
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}