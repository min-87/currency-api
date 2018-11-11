<?php
function getApiInfo()
{
    $content = file_get_contents('https://api.exchangeratesapi.io/history?start_at=2018-01-01&end_at=2018-09-01&base=USD');
    $arr_content = json_decode($content, true);
    return $arr_content;
}


function getCourseEurUsd()
{
    $content = file_get_contents('https://api.exchangeratesapi.io/latest?base=USD');
    $arr_content = json_decode($content, true);
    return $arr_content;
}

function getMiddleCourse($currency)
{
    $coursesContent = getApiInfo();
    $currencyArr = [];
    $middleCourse = 0;
    $countDays = 0;
    foreach ($coursesContent as $key => $days) {
        foreach ($coursesContent['rates'] as $dates => $courses) {
            $currencyArr[] = $courses[$currency];

        }
    }
    $countDays = count($currencyArr);
    $middleCourse = array_sum($currencyArr) / $countDays;
    return $middleCourse;
}
