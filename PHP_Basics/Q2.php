<?php
/*## Question 2: Sorting Strings

**Problem:** you are given an array of strings as below example, you have to first sort it case insensitively, and then you have to sort it case sensitively.

- In output, you have to first print the `case-insensitively`  and then `case-sensitively`  and finally the `original`  order*/

$array = ["APPLE", "Ball", "apple", "cat", "DOG", "CAT", "Camel", "FROG", "frog"];
$insensitive = $array;
$sensitive = $array;

echo ("<b>Case-Insensitively sorted:</b> <br>");
sort($insensitive ,SORT_STRING | SORT_FLAG_CASE);
echo implode(", ", $insensitive) . "<br><br>";

echo ("<b>Case-Sensitively sorted:</b> <br>");
sort($sensitive ,SORT_STRING);
echo implode(", ", $sensitive) . "<br><br>";

echo("<b>Original order:</b> <br>");
echo implode(", ", $array) . "<br><br>";















?>