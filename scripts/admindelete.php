<?php
    include('base.php');
    $table = $_POST['table'];
    $id = $_POST['id'];
    $field = $_POST['field'];  
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "DELETE FROM $table WHERE $field=$id";
    if($conn->query($sql))
    {
        header("Location: ../admin.php");
    }
    else
    {
        echo 'Cannot Delete';
    }
    $conn->close();
?>
