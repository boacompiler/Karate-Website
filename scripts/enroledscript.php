<?php
    $conn=new mysqli("localhost","root","password","website");
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM class c INNER JOIN booking b ON c.classid = b.classid WHERE b.userid = $profileuserid;";
    $result = $conn->query($sql);
    echo '<table>';
    while($row = $result->fetch_assoc())
    {
        setlocale(LC_MONETARY, 'en_GB.UTF-8');
        $gbp = money_format('%n',$row['price']);
        echo '<tr>';
        echo '<td>'.$row['name'].'</td>';
        echo '<td>'.$gbp.'</td>';
        //foreach($row as $field) 
        //{
        //    echo '<td>' . htmlspecialchars($field) . '</td>';
        //}
        echo '</tr>';
    }
    echo '</table>';
?>
