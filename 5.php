<form action="" method="get">
    Enter date from 2018-01-02 to 2018-08-31<br>
    <input type="text" name="date1" placeholder="2018-05-16"><br>
    Enter date from 2018-01-02 to 2018-08-31<br>
    <input type="text" name="date2" placeholder="2018-05-16"><br>
    <input type="submit" value="Check">
</form>
<?php
$error = '';
if (isset($_GET['date1']) != '' && isset($_GET['date2']) != '') {
    $date1 = strip_tags($_GET['date1']);
    $date2 = strip_tags($_GET['date2']);
    if (empty($date1) || empty($date2)) {
        $error = 'Please fill all fields';
    } else {
        $file_get_date1 = file_get_contents('https://api.exchangeratesapi.io/history?start_at=2018-01-01&end_at=2018-09-01&base=USD');
        $file_get_date2 = file_get_contents('https://api.exchangeratesapi.io/history?start_at=2018-01-01&end_at=2018-09-01&base=USD');
    }
} else {
    $error = '';
}
echo $error;
$res1 = 0;
$res2 = 0;

if (isset($file_get_date1) && isset($file_get_date2)) {
    $file_get_date1 = json_decode($file_get_date1, true);
    $file_get_date2 = json_decode($file_get_date2, true);
    foreach ($file_get_date1['rates'] as $key => $courses) {
        if ($key === $date1) {
            $res1 = $courses['EUR'];
            echo "Course EUR/USD on {$key} was {$res1}" . '<br>';
            break;
        }
    }
    foreach ($file_get_date2['rates'] as $key => $courses) {
        if ($key === $date2) {
            $res2 = $courses['EUR'];
            echo "Course EUR/USD on {$key} was {$res2}" . '<br>';
            break;
        }
    }
}
if ($res1 > $res2) {
    echo 'Course EUR/USD from ' . $date1 . ' to ' . $date2 . ' has gone down on ' . round(100 - ($res2 * 100 / $res1), 2) . ' %';
} elseif ($res1 < $res2) {
    echo 'Course EUR/USD from ' . $date1 . ' to ' . $date2 . ' has gone up on ' . round(100 - ($res1 * 100 / $res2), 2) . ' %';
}