<?php
    //updates table with edited values
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
        //adds content of _POST to an addressable array
        $array[] = $p;
    } 
    //drops the first 3 values of the array, as they are 'table' 'id' and 'field', not data to be updated.
    array_shift($array);
    array_shift($array);
    array_shift($array);
    for($i = 0; $i < count($array); $i=$i+2)
    {
        //the array has data in pairs, the updated data follows the field name, hence the loop increments in twos
        $sql = $sql.$array[$i].' = "'.$array[$i+1].'", ';
    }
    $sql = substr($sql, 0, -2); //we drop the last comma
    $sql = $sql.' WHERE '.$field.' = '.$id.';'; //we finish the sql
    if($conn->query($sql))
    {
        header("Location: ../admin.php");
    }
    else
    {
        echo 'Cannot Update';
        echo '<br>'.$sql;
    }
    $conn->close();
?>
