<?php
$error = '';
if (isset($_GET['amount']) != '') {
    $amount = strip_tags($_GET['amount']);
    if (empty($amount)) {
        $error = 'Please enter amount';
    } else {
        $file_get = file_get_contents('https://api.exchangeratesapi.io/latest?base=USD');
    }
} else {
    $error = '';
}
?>

<html>
<head>
    <title>Currency calculator</title>
</head>
<body>
<div>
    <form>
        Enter amount on EUR:<br>
        <input type="text" name="amount"><br>
        <input type="submit" value="Check">
    </form>
    <br>
    <?php echo $error; ?>
    <?php
    if (isset($file_get)) {
        $file_get = json_decode($file_get, true);
        foreach ($file_get['rates'] as $key => $value) {
            if ($key == 'EUR' && is_numeric($amount)) {
                $res = $value * $amount;
                echo "100 {$key} in dollars is {$res} dollars";
                break;
            } else {
                echo 'The entered number must be digit';
                break;
            }
        }
    }

    ?>

</div>
</body>
</html>

