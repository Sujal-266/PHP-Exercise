<?php
/*## Question 3: `max`  and `min`  pattern

**Problem:** you have given 2 variables with the `minimum`  and `maximum`  values, and you have to print a stare pattern based on that. */

$min = 5;
$max = 15;


for($i=1; $i<=$max; $i++){
    if($i >= $min && $i <= $max && $i %2 == 0){
        echo str_repeat("*", $i)."<br>";
    }else{
        continue;
    }

}




















?>