<?php
    //Generates a form for editing a given row in a given table
    include('base.php');
    $table = $_POST['table'];
    $id = $_POST['id'];
    $field = $_POST['field'];  
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM $table WHERE $field = $id";
    $result = $conn->query($sql);
    $sql = "SHOW COLUMNS FROM $table";
    $columnresult = $conn->query($sql);
    echo '<table style="word-wrap:break-word;">';
    echo '<tr style="font-weight:bold;">';
    while($row = $columnresult->fetch_assoc())
    {
        //prints column headings for the table
        echo '<td>'. $row['Field'].'</td>';
    }
    echo '</tr>';
    
    $columnresult = $conn->query($sql);
    while($row = $result->fetch_assoc())
    {
        //generates form for each row
        echo '<form method="post" action="adminupdate.php">';
        echo '<input type="hidden" value="'.$table.'" name="table">';
        echo '<input type="hidden" value="'.$id.'" name="id">';
        echo '<input type="hidden" value="'.$field.'" name="field">';
        echo '<tr>'; 
        $i = 0;
        foreach($row as $column)
        {
            //generates an input box for each column
            $columnrow = $columnresult->fetch_assoc();
            echo '<td>';
            echo '<input type="hidden" value="'.$columnrow['Field'].'" name="column'.$i.'">';
            echo '<input type="text" value="' . htmlspecialchars($column) . '" name="update'.$i.'"></td>'; 
            $i++;
        }
        echo '<td><input type="submit" value="Update"></td>';
        echo '</form><form action="/admin.php">';
        echo '<td><input type="submit" value="Cancel"></td>';
        echo '</tr>'; 
        echo '</form>';
    }
    echo '</table>';
    
    $conn->close();
?>
