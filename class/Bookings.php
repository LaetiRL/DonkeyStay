<?php

class Bookings
{


    public function getBookingsBetween(\DateTime $start, \DateTime $end): array
    {
        $dbh = new PDO('mysql:dbname=DonkeyStay;host=127.0.0.1', 'root', '');
        $sql = "SELECT * FROM booking WHERE start_date BETWEEN '{$start->format('Y-m-d')}' AND '{$end->format('Y-m-d')}'";
        $stm = $dbh->query($sql);
        $results = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    
}
