<?php

/*## Question 1: Student Class

**Problem:** you have to create a class Called `Student` that should have 4 properties as `name`, `roll_no`, `age`, `subjects(array).`

- This class should have 1 constructor that takes all the properties like `name`, `roll_no` etc and set it to object.
- This class should also have `addSubject` method that takes 1 subject name and add it into student’s `subjects` array.
- This class should also have `displayStudentInfo` method that print’s all student’s info like name, roll no, age etc. properly.
- Once a Class it created, we should be able to use that class to create a Student object from the code given below, and it should print the output like image below */

class Student{
    // Properties
    public $name;
    public $roll_no;
    public $age;
    public $subjects = array();


    function __construct($name,$roll_no,$age,$subjects){
        $this->name = $name;
        $this->roll_no = $roll_no;
        $this->age = $age;
        $this->subjects = $subjects;
    }

    function addSubject($subject){
        $this->subjects[] = $subject;
    }



    function displayStudentInfo(){
        echo "<strong>Name: </strong>" . $this->name . "<br>";
        echo "<strong>Roll No: </strong>" . $this->roll_no . "<br>";
        echo "<strong>Age: </strong>" . $this->age . "<br>";
        echo "<strong>Subjects: </strong>" . implode(", ", $this->subjects) . "<br>";
    }

}


//input 
$student_1 = new Student("John", 5, 21, ["Mathematics"]);
$student_1->addSubject("Physics");
$student_1->addSubject("Chemistry");

$student_1->displayStudentInfo();

?>