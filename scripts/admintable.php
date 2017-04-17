<?php
    //generates a table of a given database table on the admin page.
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    //generates a drop down menu to choose the table to display
    $sql = "SHOW TABLES;";
    $result = $conn->query($sql);
    echo '<form method="post">';
    echo '<select name="tables">';

    while($row = $result->fetch_assoc())
    {
        //adds all available database tables to the drop down
        echo '<option value="'.$row['Tables_in_'.$dbname].'">'.$row['Tables_in_'.$dbname].'</option>';
    }
    echo '</select>';
    echo '<input type="submit" value="Load">';
    echo '</form>';

    $table = $_POST['tables'];
    if($table !== '')
    {
        //loads table if one has been selected
        $field = '';

        $sql = "SELECT * FROM $table";
        $result = $conn->query($sql);
        $sql = "SHOW COLUMNS FROM $table";
        $columnresult = $conn->query($sql);
        echo '<table style="word-wrap:break-word;">';
        echo '<tr style="font-weight:bold;">';
        while($row = $columnresult->fetch_assoc())
        {
            //prints column headings
            echo '<td>'. $row['Field'].'</td>';
            if($field == '')
            {
                //sets the field variable to the primary key field title of the table
                $field = $row['Field'];
            }
        }
        echo '</tr>';
        while($row = $result->fetch_assoc())
        {
            //loops through all rows
            $id = '';
            echo '<tr>'; 
            foreach($row as $column)
            {
                //loops through every cell of a given row
                echo '<td>' . htmlspecialchars($column) . '</td>'; 
                if($id == '')
                {
                    //sets id variable to be the primary key value of the row 
                    $id = $column;
                }
            }
            //edit button
            echo '<td><form method="post" action="scripts/adminedit.php">';
            echo '<input type="hidden" name="table" value="'.$table.'">';
            echo '<input type="hidden" name="id" value="'.$id.'">';
            echo '<input type="hidden" name="field" value="'.$field.'">';
            echo '<input type="submit" value="Edit"></form></td>';
            //delete button
            echo '<td><form method="post" action="scripts/admindelete.php" onsubmit="return confirm(\'Are you sure you want to delete this?\');">';  
            echo '<input type="hidden" name="table" value="'.$table.'">';
            echo '<input type="hidden" name="id" value="'.$id.'">';
            echo '<input type="hidden" name="field" value="'.$field.'">';
            echo '<input type="submit" value="Delete"></form></td>';
            echo '</tr>'; 
        }
        echo '<tr>'; 
        //generates a form for inserting data into the table
        echo '<form method="post" action="scripts/admininsert.php">';
        echo '<input type="hidden" name="table" value="'.$table.'">';
        for ($i=0; $i < mysqli_num_fields($result); $i++)
        {
            //creates an input field for every cell
            echo '<td><input type="text" name="insert'.$i.'"></td>'; 
        }
        echo '<td><input type="submit" value="Insert"></td>';
        echo '</form>';
        echo '</tr>'; 
        echo '</table>';
    }
    $conn->close();
?>
