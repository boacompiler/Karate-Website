<?php
    include('base.php');
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM class WHERE discipline = 3";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc())
    {
        echo $row['name'].'<br>';
    }
    
    $conn->close();
?>
