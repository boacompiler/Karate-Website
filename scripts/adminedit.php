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
    $sql = "show tables;";
    $result = $conn->query($sql);
    echo '<form method="post">';
    echo '<select name="tables">';

    while($row = $result->fetch_assoc())
    {
        echo '<option value="'.$row['Tables_in_website'].'">'.$row['Tables_in_website'].'</option>';
    }
    echo '</select>';
    echo '<input type="submit" value="Load">';
    echo '</form>';

    
    $conn->close();
?>
