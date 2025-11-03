<?php

/*## Question 2: Only even pattern

**Problem:** you have given an integer variable with some value, and you have to print the stare patter that only print for each `Even`  number in iteration

- In output, you have to print stars based on the value of variable but here it should only print `Even`  line and skip all `odd`  lines */

$rows = 10;


for($i=1; $i<=$rows; $i++){
    if($i %2 == 0){
        echo str_repeat("*", $i)."<br>";

    }
    

} 


















?>