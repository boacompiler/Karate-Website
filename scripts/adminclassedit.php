<?php
    //creates a form to add a new class
    include('base.php');
    $classid = $_POST['classid'];
    if(!(isset($_SESSION['loggedin']) and $_SESSION['admin'] == '1'))
    {
        die();
    }
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM class WHERE classid = $classid;"; 
    $result = $conn->query($sql);
    $disciplinesql="SELECT * FROM discipline;";
    $dicsiplineresult = $conn->query($disciplinesql);
    $teachersql="SELECT * FROM user WHERE admin = 1;";
    $teacherresult= $conn->query($teachersql);
    $timeslotsql="SELECT * FROM timeslot;";
    $timeslotresult= $conn->query($timeslotsql);
    
    $conn->close();
    $value = $result->fetch_assoc();
?>
<table>
<form method="post" action="adminclassupdate.php">
<tr><td>Name</td><td><input type="text" name="name" value="<?php echo $value['name']?>"></td></tr>
<tr><td>Discipline</td><td><select name="discipline">
<?php
    $disciplineid = $value['discipline'];
    while($row = $dicsiplineresult->fetch_assoc())
    {
        $optionid = $row['disciplineid'];
        $option = '<option value="'.$optionid.'"';
        if($optionid == $disciplineid)
        {
            $option = $option.' selected="selected"';
        }
        $option = $option.'>'.$row['name'].'</option>';
        echo $option;
    }
?>
</select></td></tr>
<tr><td>Description</td><td><textarea type="text" name="description" ><?php echo $value['description']?></textarea></td></tr>
<tr><td>Teacher</td><td><select name="teacher">
<?php
    $teacherid = $value['teacher'];
    while($row = $teacherresult->fetch_assoc())
    {
        $optionid = $row['userid'];
        $option = '<option value="'.$row['userid'].'"';
        if($optionid == $teacherid)
        {
            $option = $option.' selected="selected"';
        }
        $option = $option.'>'.$row['namefirst'].' '.$row['namesecond'].'</option>';
        echo $option;
    }
?>
</select></td></tr>
<tr><td>Price</td><td><input type="number" min="0.00" step="0.01" max="500" name="price"value="<?php echo $value['price']?>"/></td></tr>
<tr><td>Timeslot</td><td><select name="timeslot">
<?php
    $timeslotid = $value['timeslot'];
    while($row = $timeslotresult->fetch_assoc())
    {
        $optionid = $row['timeslotid'];
        $option = '<option value="'.$row['timeslotid'].'"';
        if($optionid == $timeslotid)
        {
            $option = $option.' selected="selected"';
        }
        $option = $option.'>'.$row['day'].' '.$row['timebegin'].'-'.$row['timeend'].'</option>';
        echo $option;
    }
?>
</select></td></tr>
<input type="hidden" name="classid" value="<?php echo $classid?>"> 
<tr><td><input type="submit" value="Submit"></td>
</form>
<form action="../adminclass.php">
<td><input type="submit" value="Cancel"></td>
</form></tr>
</table>

