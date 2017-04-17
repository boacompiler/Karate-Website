<?php
    //prints a table of all enroled classes for a given user
    include('base.php');
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    //selcts values from class, booking and user tables
    $sql = "SELECT * FROM class c INNER JOIN booking b ON c.classid = b.classid INNER JOIN user u ON c.teacher = u.userid INNER JOIN timeslot t ON c.timeslot = t.timeslotid WHERE b.userid = $profileuserid;"; 
    $result = $conn->query($sql);
    //column headings
    echo '<table>';
    echo '<tr style="font-weight:bold;">';
    echo '<td>Class</td>';
    echo '<td>Instructor</td>';
    echo '<td>Start</td>';
    echo '<td>Hours</td>';
    echo '<td>Price</td>';
    echo '</tr>';
    while($row = $result->fetch_assoc())
    {
        //loops through all enroled classes, printing details
        setlocale(LC_MONETARY, 'en_GB.UTF-8'); //sets currency to gbp (£)
        $gbp = money_format('%n',$row['price']);
        $length = $row['timeend'] - $row['timebegin'];
        echo '<tr>';
        echo '<td>'.$row['name'].'</td>';
        echo '<td>'.$row['namefirst']." ".$row['namesecond'].'</td>';
        echo '<td>'.substr($row['timebegin'], 0, -3).'</td>';
        echo '<td>'.$length.'</td>';
        echo '<td>'.$gbp.'</td>';
        //creates button to cancel enrolement
        echo '<td><form method="post" action="scripts/cancel.php"><input type="hidden" name="cancelclassid" value="'.$row['classid'].'"><input type="submit" value="Cancel" ></form></td>';
        echo '</tr>';
    }
    echo '</table>';
    $conn->close();
?>
