<?php
    //creates a form to add a new user 
    include('base.php');
    $userid = $_POST['userid'];
    if(!(isset($_SESSION['loggedin']) and $_SESSION['admin'] == '1'))
    {
        die();
    }
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM user WHERE userid = $userid;"; 
    $result = $conn->query($sql);
    $conn->close();
    $value = $result->fetch_assoc();
    $admin = "";
    if($value['admin']==1)
    {
        $admin = "checked";
    }
?>
<html>
<head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" >
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        $( "#datepicker" ).datepicker({dateFormat: "yy-mm-dd"}).val(); 
    } );
</script>
</head>
<body>
<table>
<form method="post" action="adminuserupdate.php">
<tr><td>Date of birth</td><td><input type="text" name="dob" id="datepicker" value="<?php echo $value['dateofbirth']?>"></td></tr>
<tr><td>First Name</td><td><input type="text" name="namefirst" value="<?php echo $value['namefirst']?>"></td></tr>
<tr><td>Second Name</td><td><input type="text" name="namesecond" value="<?php echo $value['namesecond']?>"></td></tr>
<tr><td>Email</td><td><input type="text" name="email" value="<?php echo $value['email']?>"></td></tr>
<tr><td>Admin</td><td><input type="checkbox" name="admin" <?php echo $admin?>></td></tr>
<tr><td colspan="2" style="color:red;">Only edit password if resetting</td></tr>
<tr><td>Password</td><td><input type="password" name="password"></td></tr>
<input type="hidden" name="userid" value="<?php echo $userid?>">
<tr><td><input type="submit" value="Submit"></td>
</form>
<form action="../adminuser.php">
<td><input type="submit" value="Cancel"></td>
</form></tr>
</table>
</body>
</html>
