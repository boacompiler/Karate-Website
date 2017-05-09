<?php
    //creates a form to add a new class
    include('base.php');
    if(!(isset($_SESSION['loggedin']) and $_SESSION['admin'] == '1'))
    {
        die();
    }
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $roomsql="SELECT * FROM room;";
    $roomresult= $conn->query($roomsql);

    $conn->close();
    $days = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
?>
<table>
<form method="post" action="admintimeinsert.php">
<tr><td>Start</td><td><table><tr>
<td><input type="number" min="0" step="1" max="23" name="starthours" style="width:50px" value="00"/></td>
<td>:</td>
<td><input type="number" min="0" step="1" max="59" name="startminutes" style="width:50px" value="00"/></td>
</tr></table></td></tr>
<tr><td>End</td><td><table><tr>
<td><input type="number" min="0" step="1" max="23" name="endhours" style="width:50px" value="00"/></td>
<td>:</td>
<td><input type="number" min="0" step="1" max="59" name="endminutes" style="width:50px" value="00"/></td>
</tr></table></td></tr>
<tr><td>Room</td><td><select name="room">
<?php
    while($row = $roomresult->fetch_assoc())
    {
        echo '<option value="'.$row['roomid'].'">'.$row['name'].'</option>';
    }
?>
</select></td></tr>
<tr><td>Day</td><td><select name="day">
<?php
    for($i = 0; $i < count($days); $i++)
    {
        echo '<option value="'.$days[$i].'">'.$days[$i].'</option>';
    }
?>
</select></td></tr>

<tr><td><input type="submit" value="Submit"></td>
</form>
<form action="../admintime.php">
<td><input type="submit" value="Cancel"></td>
</form></tr>
</table>

