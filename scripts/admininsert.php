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
    $sql = '';
    foreach($_POST as $p)
    {
        if($sql =='')
        {
            $sql = 'INSERT INTO '.$p.' VALUES (';
        }
        else
        {
            $sql = $sql.'"'.$p.'",';
        }
    } 
    $sql = substr($sql, 0, -1);
    $sql = $sql.');';
    if($conn->query($sql))
    {
        header("Location: /admin.php");
    }
    else
    {
        echo 'Cannot Insert';
        echo '<br>'.$sql;
    }
    $conn->close();
?>
