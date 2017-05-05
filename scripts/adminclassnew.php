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
    $disciplinesql="SELECT * FROM discipline;";
    $dicsiplineresult = $conn->query($disciplinesql);
    $teachersql="SELECT * FROM user WHERE admin = 1;";
    $teacherresult= $conn->query($teachersql);
    $timeslotsql="SELECT * FROM timeslot;";
    $timeslotresult= $conn->query($timeslotsql);
    
    $conn->close();
?>
<table>
<form method="post" action="adminclassinsert.php">
<tr><td>Name</td><td><input type="text" name="name"></td></tr>
<tr><td>Discipline</td><td><select name="discipline">
<?php
    while($row = $dicsiplineresult->fetch_assoc())
    {
        echo '<option value="'.$row['disciplineid'].'">'.$row['name'].'</option>';
    }
?>
</select></td></tr>
<tr><td>Description</td><td><textarea type="text" name="description"></textarea></td></tr>
<tr><td>Teacher</td><td><select name="teacher">
<?php
    while($row = $teacherresult->fetch_assoc())
    {
        echo '<option value="'.$row['userid'].'">'.$row['namefirst'].' '.$row['namesecond'].'</option>';
    }
?>
</select></td></tr>
<tr><td>Price</td><td><input type="number" min="0.00" step="0.01" max="500" name="price"/></td></tr>
<tr><td>Timeslot</td><td><select name="timeslot">
<?php
    while($row = $timeslotresult->fetch_assoc())
    {
        echo '<option value="'.$row['timeslotid'].'">'.$row['day'].' '.$row['timebegin'].'-'.$row['timeend'].'</option>';
    }
?>
</select></td></tr>
<tr><td><input type="submit" value="Submit"></td>
</form>
<form action="../adminclass.php">
<td><input type="submit" value="Cancel"></td>
</form></tr>
</table>

