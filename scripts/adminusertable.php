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
    $sql = "SELECT * FROM user;";
    $classquery = "SELECT u.userid,COUNT(b.classid) FROM user u LEFT JOIN booking b ON b.userid= u.userid GROUP BY u.userid;";
    $result = $conn->query($sql);
    $classno = $conn->query($classquery);
    echo '<table border=1px style="border-collapse:collapse">';
    echo '<tr style="font-weight:bold;">';
    echo '<td>Name</td>';
    echo '<td>Email</td>';
    echo '<td>Date of birth</td>';
    echo '<td>Admin</td>';
    echo '<td>Number of classes</td>';
    echo '</tr>';
    
    while($row = $result->fetch_assoc())
    {
        $classcount = $classno->fetch_assoc();
        echo '<tr>';
        echo '<td>'.$row['namefirst'].' '.$row['namesecond'].'</td>';
        echo '<td>'.$row['email'].'</td>';
        echo '<td>'.$row['dateofbirth'].'</td>';
        if($row['admin']==1)
        {
            echo '<td style="color:red">yes</td>';
        }
        else
        {
            echo '<td>no</td>';
        }
        echo '<td>'.$classcount['COUNT(b.classid)'].'</td>';
        //edit button
        echo '<td><form method="post" action="scripts/adminuseredit.php">';
        echo '<input type="hidden" name="userid" value="'.$row['userid'].'">';
        echo '<input type="submit" value="Edit"></form></td>';
        //delete button
        echo '<td><form method="post" action="scripts/adminuserdelete.php" onsubmit="return confirm(\'Are you sure you want to delete this?\');">';
        echo '<input type="hidden" name="userid" value="'.$row['userid'].'">';
        echo '<input type="submit" value="Delete"></form></td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<form method="post" action="scripts/adminusernew.php">';
    echo '<input type="submit" value="New"></form></td>';
    echo '</form>';
    $conn->close();
?>
