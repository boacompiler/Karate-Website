<?php
    session_start();
    $email=$_POST['email'];
    $password=$_POST['password'];
    $conn=new mysqli("localhost","root","password","website");
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM user WHERE password='$password' AND email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) 
    {
        $row = $result->fetch_assoc();
        $_SESSION['loggedin'] = 'true';  
        $_SESSION['admin'] = $row['admin'];
        $_SESSION['firstname'] = $row['namefirst'];
        $_SESSION['secondname'] = $row['namesecond'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['dob'] = $row['dateofbirth'];
        header("Location: /profile.php");
    }
    else
    {
        echo "something went wrong";
    }
    $conn->close();
    die();
?> 
