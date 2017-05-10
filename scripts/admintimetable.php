<?php
    //generates a table of timeslots
    if(!(isset($_SESSION['loggedin']) and $_SESSION['admin'] == '1'))
    {
        die();
    }
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM timeslot t INNER JOIN room r ON t.room = r.roomid;";
    $result = $conn->query($sql);
    echo '<table border=1px style="border-collapse:collapse">';
    echo '<tr style="font-weight:bold;">';
    echo '<td>Start</td>';
    echo '<td>End</td>';
    echo '<td>Duration</td>';
    echo '<td>Room</td>';
    echo '<td>Day</td>';
    echo '<td>Classes</td>';
    echo '</tr>';
    
    while($row = $result->fetch_assoc())
    {
        $classquery = "SELECT name FROM class WHERE timeslot = '".$row['timeslotid']."';";
        $classresult = $conn->query($classquery);
        $length = $row['timeend'] - $row['timebegin'];
        echo '<tr>';
        echo '<td>'.$row['timebegin'].'</td>';
        echo '<td>'.$row['timeend'].'</td>';
        echo '<td>'.$length.'</td>';
        echo '<td>'.$row['name'].'</td>';
        echo '<td>'.$row['day'].'</td>';
        echo '<td>';
        While($class = $classresult->fetch_assoc())
        {
            echo $class['name']."<br>";
        }
        echo '</td>';
        //edit button
        echo '<td><form method="post" action="scripts/admintimeedit.php">';
        echo '<input type="hidden" name="timeslotid" value="'.$row['timeslotid'].'">';
        echo '<input type="submit" value="Edit"></form></td>';
        //delete button
        echo '<td><form method="post" action="scripts/admintimedelete.php" onsubmit="return confirm(\'Are you sure you want to delete this?\');">';
        echo '<input type="hidden" name="timeslotid" value="'.$row['timeslotid'].'">';
        echo '<input type="submit" value="Delete"></form></td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<form method="post" action="scripts/admintimenew.php">';
    echo '<input type="submit" value="New"></form></td>';
    echo '</form>';
    $conn->close();
?>
