<?php
$error = '';
if (isset($_GET['currency']) != '' && isset($_GET['amount']) != '') {

    $currency = strip_tags($_GET['currency']);
    $amount = strip_tags($_GET['amount']);
    if (empty($currency) && empty($amount)) {
        $error = 'Please fill are fields';
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
        Select currency:
        <select name="currency">
            <option>CAD</option>
            <option>EUR</option>
            <option>GBP</option>
            <option>AUD</option>
            <option>JPY</option>
        </select>
        <br>
        Enter amount:
        <input type="text" name="amount"><br>
        <input type="submit" value="Check">
    </form>
    <br>
    <?php echo $error; ?>
    <?php
    if (isset($file_get)) {
        $file_get = json_decode($file_get, true);
        foreach ($file_get['rates'] as $key => $value) {
            if ($currency == $key && is_numeric($amount)) {
                echo $amount . ' ' . $currency . ' = ' . ($value * $amount) . ' dollars';
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

