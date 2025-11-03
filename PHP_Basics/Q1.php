<?php

## Question 1: Sorting integers

/***Problem:** you have given the array of integer as below example, you have to sort the array in ascending order 1st and then in descending order as well.

- In **output**, you have to first print the integers in `ascending`  order and then `descending`  and at the end you also have to print the `original`  array’s elements as well
- example image is also given*/

$array = [68, 6, 2, 12, 4, 6, 34, 34, 6];
$asc = $array;
$dsc = $array;


// Sorting in ascending order
echo("<b>Ascending order:</b> <br>");
sort($asc);
echo implode(", ", $asc) . "<br>";
echo "<br>";

// Sorting in descending order
echo("<b>Descending order:</b> <br>");
rsort($dsc);
echo implode(",", $dsc) . "<br>";
echo "<br>";


// Original order
echo("<b>Original order:</b> <br>");
echo implode(",", $array) ."<br>";







?>