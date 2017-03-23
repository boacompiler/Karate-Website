<?php
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

    $table = $_POST['tables'];
    if($table !== '')
    {
        $field = '';

        $sql = "SELECT * FROM $table";
        $result = $conn->query($sql);
        $sql = "SHOW COLUMNS FROM $table";
        $columnresult = $conn->query($sql);
        echo '<table style="word-wrap:break-word;">';
        echo '<tr style="font-weight:bold;">';
        while($row = $columnresult->fetch_assoc())
        {
            echo '<td>'. $row['Field'].'</td>';
            if($field == '')
            {
                $field = $row['Field'];
            }
        }
        echo '</tr>';
        while($row = $result->fetch_assoc())
        {
            $id = '';
            echo '<tr>'; 
            foreach($row as $column)
            {
                echo '<td>' . htmlspecialchars($column) . '</td>'; 
                if($id == '')
                {
                    $id = $column;
                }
            }
            //edit
            echo '<td><form method="post" action=""><input type="submit" value="Edit"></form></td>';
            //delete
            echo '<td><form method="post" action="scripts/admindelete.php">';  
            echo '<input type="hidden" name="table" value="'.$table.'">';
            echo '<input type="hidden" name="id" value="'.$id.'">';
            echo '<input type="hidden" name="field" value="'.$field.'">';
            echo '<input type="submit" value="Delete"></form></td>';
            echo '</tr>'; 
        }
        echo '<tr>'; 
        echo '<form method="post" action="scripts/admininsert.php">';
        echo '<input type="hidden" name="table" value="'.$table.'">';
        for ($i=0; $i < mysqli_num_fields($result); $i++)
        {
           echo '<td><input type="text" name="insert'.$i.'"></td>'; 
        }
        echo '<td><input type="submit" value="Insert"></td>';
        echo '</form>';
        echo '</tr>'; 
        echo '</table>';
    }
    $conn->close();
?>
