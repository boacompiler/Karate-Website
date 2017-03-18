<?php
    session_start();
    $email=$_POST['email'];
    $password=$_POST['password'];
    $conn=new mysqli("localhost","root","password","website");
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM user";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc())
        {
            echo $row["namefirst"] . " " . $row["namesecond"];
        }
    }
    $conn->close();
?> 
