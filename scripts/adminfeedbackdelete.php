<?php
    //deletes feedback
    include('base.php');

    $feedbackid = $_POST['feedbackid']; 

    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM feedback WHERE feedbackid = $feedbackid;";
    $result = $conn->query($sql);
    if($result->num_rows == 1)
    {
        $sqldelete = "DELETE FROM feedback WHERE feedbackid = $feedbackid;";
        if($conn->query($sqldelete))
        {
            header("Location: ../adminfeedback.php");
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
    $conn->close();
?>
