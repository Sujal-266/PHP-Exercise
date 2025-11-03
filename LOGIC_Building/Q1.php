<?php   

/*## Question 1: normal pattern

**Problem:** you have given an Integer variable with some value, and you have to print the stare patter shown in the image below

- In **output**, it should print stars based on the value of variable. If the value is 5 then it should print 5 lines with starts increasing by each line */

$rows = 5;

for($i=1; $i<=$rows; $i++){
    for($j=1; $j<=$i; $j++){
        echo "*";
    }

    echo "</br>";

}


?>