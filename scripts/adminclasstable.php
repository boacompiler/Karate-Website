<?php
    if(!(isset($_SESSION['loggedin']) and $_SESSION['admin'] == '1'))
    {
        die();
    }
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * ,d.name as disciplinename,c.name as classname FROM class c INNER JOIN user u ON c.teacher = u.userid LEFT JOIN timeslot t ON c.timeslot = t.timeslotid INNER JOIN discipline d ON c.discipline = d.disciplineid;";
    $studentquery = "SELECT c.classid,COUNT(b.userid) FROM class c LEFT JOIN booking b ON b.classid = c.classid GROUP BY c.classid;";
    $result = $conn->query($sql);
    $studentno = $conn->query($studentquery);
    setlocale(LC_MONETARY, 'en_GB.UTF-8'); //sets the currency to gbp (£) 
    echo '<table border=1px style="border-collapse:collapse">';
    echo '<tr style="font-weight:bold;">';
    echo '<td>Name</td>';
    echo '<td>Discipline</td>';
    echo '<td>Teacher</td>';
    echo '<td>Start</td>';
    echo '<td>End</td>';
    echo '<td>Day</td>';
    echo '<td>Price</td>';
    echo '<td>Students</td>';
    echo '</tr>';
    
    while($row = $result->fetch_assoc())
    {
        $studentcount = $studentno->fetch_assoc();
        $gbp = money_format('%n',$row['price']);
        echo '<tr>';
        echo '<td>'.$row['classname'].'</td>';
        echo '<td>'.$row['disciplinename'].'</td>';
        echo '<td>'.$row['namefirst'].' '.$row['namesecond'].'</td>';
        echo '<td>'.$row['timebegin'].'</td>';
        echo '<td>'.$row['timeend'].'</td>';
        echo '<td>'.$row['day'].'</td>';
        echo '<td>'.$gbp.'</td>';
        echo '<td>'.$studentcount['COUNT(b.userid)'].'</td>';
        //edit button
        echo '<td><form method="post" action="scripts/adminclassedit.php">';
        echo '<input type="hidden" name="classid" value="'.$row['classid'].'">';
        echo '<input type="submit" value="Edit"></form></td>';
        //delete button
        echo '<td><form method="post" action="scripts/adminclassdelete.php" onsubmit="return confirm(\'Are you sure you want to delete this?\');">';
        echo '<input type="hidden" name="classid" value="'.$row['classid'].'">';
        echo '<input type="submit" value="Delete"></form></td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<form method="post" action="scripts/adminclassnew.php">';
    echo '<input type="submit" value="New"></form></td>';
    echo '</form>';
    $conn->close();
?>
