<?php
/*## Question 3: Sorting MIX data

**Problem:** you have given an array of Strings and Integer mix as below example. You have to sort it in a way that integers gets first in ascending order and then string gets sorted `case-insensitively` and also reverse as well (first string and then integer)

- in output, first you have to print where all integers get first in `ascending`  order and then print the string sorted `case-insensitively`.
- Then you have to print it where all string gets first sorted `case-sensitively`  and then all integers in `descending`  order
- Then you have to print the original Array*/

$array = [2, "APPLE", 3, "Ball", "apple", 5, "cat", "DOG", "CAT", "Camel", 6, "FROG", "frog"];

echo("<b>Integers in Ascending order and Strings Case-Insensitively:</b><br>");

$ints = array_filter($array, 'is_int');
$strings = array_filter($array, 'is_string');

sort($ints, SORT_NUMERIC);

usort($strings, function($a, $b) {
    return strcasecmp($a, $b);
});

$ascCaseInsensitive = array_merge($ints, $strings);

foreach ($ascCaseInsensitive as $value) {
    echo $value . ",";
}

echo("<br><br><b>Strings in Ascending order (case-sensitive) and Integers in Descending order:</b><br>");
sort($strings, SORT_STRING);

rsort($ints, SORT_NUMERIC);

$descCaseSensitive = array_merge($strings, $ints);

foreach ($descCaseSensitive as $value) {
    echo $value . ",";
}

echo("<br><br><b>Original Array:</b><br>");
foreach ($array as $value) {
    echo $value . ",";
}

?>
















?>