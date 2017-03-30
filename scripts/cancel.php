<?php
    include('base.php');

    $classid = $_POST['cancelclassid']; 
    $userid = $_SESSION['userid'];

    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM booking WHERE classid = $classid AND userid = $userid";
    $result = $conn->query($sql);
    if($result->num_rows == 1)
    {
        $sqldelete = "DELETE FROM booking WHERE classid = $classid AND userid = $userid";
        if($conn->query($sqldelete))
        {
            header("Location: ../profile.php");
        }
        else
        {
            echo "Database error";
        }
    }
    else
    {
        echo "Database error";
    }
    echo "fin";
    $conn->close();
?>
