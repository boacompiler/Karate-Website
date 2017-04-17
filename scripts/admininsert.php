<?php
    //inserts a new row into a given table
    include('base.php');
    $table = $_POST['table'];
    $id = $_POST['id'];
    $field = $_POST['field'];  
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = '';
    foreach($_POST as $p)
    {
        //loops through all provided values, generating a statement to insert them
        if($sql =='')
        {
            //the first value posted is the table name, so on first loop we run this
            $sql = 'INSERT INTO '.$p.' VALUES (';
        }
        else
        {
            //all over posted values are added into the VALUES section of the statement
            $sql = $sql.'"'.$p.'",';
        }
    } 
    $sql = substr($sql, 0, -1); //we remove the comma from the last value
    $sql = $sql.');'; // we close the statement
    if($conn->query($sql))
    {
        header("Location: ../admin.php");
    }
    else
    {
        echo 'Cannot Insert';
        echo '<br>'.$sql;
    }
    $conn->close();
?>
