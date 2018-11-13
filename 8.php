<?php
/**
 * Написать калькулятор валют. Например php 8.php 100 USD. Ваш скрипт должен вывести сумму в евро,
 * 100 USD = 85 EUR
 */
$currency_rates = json_decode(file_get_contents('https://api.exchangeratesapi.io/latest?base=EUR'),true);

if (isset($argv[1]) && isset($argv[2])){
    $client_current=$argv[2];
    if (isset($currency_rates['rates'][$client_current])){
       $rate=$currency_rates['rates'][$client_current];
       echo "{$argv[1]} {$argv[2]} = ".($argv[1]/$rate).' EUR';
    }else{
        echo 'No such currency code';
    }
}else{
    echo 'No params';
}