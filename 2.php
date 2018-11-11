<?php
include 'lib.php';
$coursesContent = getApiInfo();
$keys = [];
foreach ($coursesContent['rates'] as $dates) {
    foreach ($dates as $key => $value) {
        if (!in_array($key, $keys) && $key != 'USD' && $key != 'ISK') {
            $keys[] = $key;
        }
    }
}
$result = [];
foreach ($keys as $currency) {
    $result[] = getMiddleCourse($currency);
}

$assocArr = array_combine($keys, $result);
print_r($assocArr);

