<?php
/*## Question 2: Multidimensional array

**Problem:** you have given multidimensional array of user data with info about `name` , `id`  and `age` 

- first, you have to sort this array based on user's name and print the names of all users. The sort should be `case-insensitively`
- then you have to filter this array and print names of all users with age greater than `18`
- there is another variable `$search`  which can have any value and you have to print all the names that match with the `$search`  variable’s value. keep in mind that `$search`  doesn’t need to match exactly with data. for example if name is `anabella`  and search is `anabel`  then it should still print `anabella` . also search should be `case-insensitively`, means “CAR” and “car” is same while searching. */

//input 
$search = "car";
$users = [
    [
        "id" => 1,
        "name" => "John carter",
        "age" => 29
    ],
    [
        "id" => 2,
        "name" => "Mary jane",
        "age" => 10
    ],
    [
        "id" => 3,
        "name" => "jenna ortega",
        "age" => 18
    ],
    [
        "id" => 4,
        "name" => "bob marley",
        "age" => 20
    ],
    [
        "id" => 5,
        "name" => "TOM CARLSON",
        "age" => 25
    ]
];

$name = array_column($users, 'name');

echo "<b> Users sorted by name (case-insensitively): </b><br>";
sort($name ,SORT_STRING | SORT_FLAG_CASE);
echo implode(", ", $name). "<br><br>";

$age = array_column($users, 'age');
echo "<b>Users over 18 years old: </b><br>";
foreach ($users as $key => $value) {
    if ($value['age'] > 18) {
        echo $value['name'] . ", ";
    } else {
        continue;
    }

}
echo "<br><br>";

echo "<b>Search results for \"car\" : </b><br>";
foreach ($users as $key => $value) {
    if (stripos($value['name'], $search) !== false) {
        echo $value['name'] . ", ";
    } else {
        continue;
    }
}       




























?>