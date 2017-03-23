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
    $sql = 'UPDATE '.$table.' SET ';
    $array = array();
    foreach($_POST as $p)
    {
        $array[] = $p;
    } 
    array_shift($array);
    array_shift($array);
    array_shift($array);
    for($i = 0; $i < count($array); $i=$i+2)
    {
        $sql = $sql.$array[$i].' = "'.$array[$i+1].'", ';
    }
    $sql = substr($sql, 0, -2);
    $sql = $sql.' WHERE '.$field.' = '.$id.';';
    if($conn->query($sql))
    {
        header("Location: /admin.php");
    }
    else
    {
        echo 'Cannot Update';
        echo '<br>'.$sql;
    }
    $conn->close();
?>
