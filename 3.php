<form action="" method="get">
    Select date from 2018-01-02 to 2018-08-31<br>
    <input type="text" name="date" placeholder="2018-05-16"><br>
    <input type="submit" value="Check">
</form>
<?php
$error = '';
if (isset($_GET['date']) != '') {
    $date = strip_tags($_GET['date']);
    if (empty($date)) {
        $error = 'Please select date';
    } else {
        $file_get = file_get_contents('https://api.exchangeratesapi.io/history?start_at=2018-01-01&end_at=2018-09-01&base=USD');
    }
} else {
    $error = '';
}
echo $error;

if (isset($file_get)) {
    $file_get = json_decode($file_get, true);
    foreach ($file_get['rates'] as $key => $courses) {
        if ($key == $date) {
            echo "Course EUR on {$key} = {$courses['EUR']} dollars";
            break;
        }
    }

}