<?php

/*## Question 1: palindrome

**Problem:** you have given an array of strings as shown in example

- you have to separate this strings into `palindrome`  and `non-palindrome`  strings and print them separately.
- Keep in mind that only 1 character like `a`  **doesn’t** considered a palindrome
- the output should look something like the image shown */
//input 
$array = ["radar", "level", "civicus", "noon","k", "madamsir", "madam", "racecarp", "a"];

$palindrome;
$non_palindrome;

foreach ($array as $key => $value) {
    $reversed = strrev($value);
    if ($value === $reversed && strlen($value) > 1) {
        $palindrome[] = $value;
    } else {
        $non_palindrome[] = $value;
    }
}


echo "<b>Palindrome Strings: </b><br>";
foreach ($palindrome as $p) {
    echo $p . ",\n";
}
echo "<br>";

echo "<br>";
echo "<b>Non-Palindrome Strings: </b><br>";
foreach ($non_palindrome as $p) {   
    echo $p . ",\n";
}       





?>