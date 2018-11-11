<?php
include 'lib.php';
$coursesContent = getApiInfo();
$eur_usd = getMiddleCourse('EUR');
echo "Middle course EUR/USD from {$coursesContent['start_at']} to {$coursesContent['end_at']} is {$eur_usd}";



