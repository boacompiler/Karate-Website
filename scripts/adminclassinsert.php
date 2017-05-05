<?php
    include('base.php');
    if(!(isset($_SESSION['loggedin']) and $_SESSION['admin'] == '1'))
    {
        die();
    }
    $name = $_POST['name'];
    $discipline= $_POST['discipline'];
    $description= $_POST['description'];
    $teacher= $_POST['teacher'];
    $price= $_POST['price'];
    $timeslot= $_POST['timeslot'];
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $_name= mysqli_real_escape_string($conn,$name);
    $_description= mysqli_real_escape_string($conn,$description);
    $_price= mysqli_real_escape_string($conn,$price);
    $sql="INSERT INTO `class`(`discipline`, `name`, `description`, `timeslot`, `teacher`, `price`) VALUES ('$discipline','$_name','$_description','$timeslot','$teacher','$_price');";
    if($conn->query($sql))
    {
        header("Location: ../adminclass.php");
    }
    else
    {
        echo 'Cannot insert';
    }
    $conn->close();
?>
