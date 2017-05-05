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
    $sql="SELECT * FROM feedback f INNER JOIN user u ON f.userid = u.userid";
    $result = $conn->query($sql);
    echo '<table>';
    while($row = $result->fetch_assoc())
    {
        echo '<tr>';
        echo '<td>'.nl2br($row['feedback']).'</td>';
        echo '<td style="font-weight:bold;">'.$row['namefirst'].' '.$row['namesecond'].'<td>';
        echo '<td><form method="post" action="scripts/adminfeedbackdelete.php" onsubmit="return confirm(\'Are you sure you want to delete this?\');"><input type="hidden" name="feedbackid" value="'.$row['feedbackid'].'"><input type="submit" value="Delete" ></form></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td style="font-weight:bold;">'.$row['email'].'</td>'; 
        echo '</tr>';
    }
    echo '</table>';
    $conn->close();
?>
