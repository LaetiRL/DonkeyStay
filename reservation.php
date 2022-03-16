<?php
$titleWeb = "Mes Réservation";
require_once "header.php";
require_once "class/Month.php";
require_once "class/Bookings.php";

$bookings = new Bookings;
$month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);
$start = $month->getStartingDay();
$start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
$weeks = $month->getWeeks();
$end = (clone $start)->modify('+' . (6 + 7 * ($weeks - 1)). ' days');
$bookings = $bookings->getBookingsBetween($start, $end);
var_dump($bookings);
?>

<h1><?= $month->toString() ?></h1>
<div class="d-flex">
    <a href="reservation.php?month=<?php echo $month->previousMonth()->month; ?>&year=<?php echo $month->previousMonth()->year; ?>" class="btn btn-secondary ms-3">&lt</a>
    <a href="reservation.php?month=<?php echo $month->nextMonth()->month; ?>&year=<?php echo $month->nextMonth()->year; ?>" class="btn btn-secondary ms-3">&gt</a>
</div>
<table>
    <?php for ($i = 0; $i < $weeks; $i++): ?>
    <tr>
        <?php foreach ($month->days as $k => $day):
            $date = (clone $start)->modify("+" . ($k + $i * 7) . " days");
            $bookingsC = $bookings[$date->format('Y-m-d')] ?? [];
            ?>
        <td class="<?php echo $month->withinMonth($date) ? '' : 'calendar-othermonth'; ?>">
            <div><?php echo $date->format('d'); ?></div>
        </td>
    <?php endforeach; ?>        
    </tr>
    <?php endfor; ?>
</table>