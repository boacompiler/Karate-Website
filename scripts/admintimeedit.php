<?php
    //creates a form to add a new timeslot 
    include('base.php');
    $timeslotid = $_POST['timeslotid'];
    if(!(isset($_SESSION['loggedin']) and $_SESSION['admin'] == '1'))
    {
        die();
    }
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    } $sql = "SELECT * FROM timeslot WHERE timeslotid = $timeslotid;";
    $result = $conn->query($sql);
    $roomsql="SELECT * FROM room;";
    $roomresult= $conn->query($roomsql);

    $conn->close();
    $days = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
    $value = $result->fetch_assoc();

    $starthoursvalue = substr($value['timebegin'],0,2);
    $startminutesvalue = substr($value['timebegin'],3,2);
    $endhoursvalue = substr($value['timeend'],0,2);
    $endminutesvalue = substr($value['timeend'],3,2);
?>
<table>
<form method="post" action="admintimeupdate.php">
<tr><td>Start</td><td><table><tr>
<td><input type="number" min="0" step="1" max="23" name="starthours" style="width:50px" value="<?php echo $starthoursvalue?>"/></td>
<td>:</td>
<td><input type="number" min="0" step="1" max="59" name="startminutes" style="width:50px" value="<?php echo $startminutesvalue?>"/></td>
</tr></table></td></tr>
<tr><td>End</td><td><table><tr>
<td><input type="number" min="0" step="1" max="23" name="endhours" style="width:50px" value="<?php echo $endhoursvalue?>"/></td>
<td>:</td>
<td><input type="number" min="0" step="1" max="59" name="endminutes" style="width:50px" value="<?php echo $endminutesvalue?>"/></td>
</tr></table></td></tr>
<tr><td>Room</td><td><select name="room">
<?php
    $roomid = $value['room'];
    while($row = $roomresult->fetch_assoc())
    {
        $optionid = $row['roomid'];
        $option = '<option value="'.$row['roomid'].'"';
        if($optionid == $roomid)
        {
            $option = $option.' selected="selected"';
        }
        $option = $option.'>'.$row['name'].'</option>';
        echo $option;
    }
?>
</select></td></tr>
<tr><td>Day</td><td><select name="day">
<?php
    $day = $value['day'];
    for($i = 0; $i < count($days); $i++)
    {
        $optionday = $days[$i];
        $option = '<option value="'.$days[$i].'"';
        if($optionday == $day)
        {
            $option = $option.' selected="selected"';
        }
        $option = $option.'>'.$days[$i].'</option>';
        echo $option;
    }
?>
</select></td></tr>
<input type="hidden" name="timeslotid" value="<?php echo $timeslotid?>">
<tr><td><input type="submit" value="Submit"></td>
</form>
<form action="../admintime.php">
<td><input type="submit" value="Cancel"></td>
</form></tr>
</table>

