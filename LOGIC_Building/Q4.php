<?php
/*## Question 4: Mirror Pattern

**Problem:** you have given an integer variable with some value, and you have to print the stare pattern based on that

- In output, it first prints the stare in increasing order and once it’s done then it should print it in decreasing order as well */

$rows = 10;

for ($i = 0; $i < $rows; $i++) {
    echo str_repeat("*", $i + 1) . "<br>";
}

for ($i = $rows - 1; $i > 0; $i--) {
    echo str_repeat("*", $i) . "<br>";
}















?>