<?php
    //creates a form to add a new user 
    include('base.php');
    if(!(isset($_SESSION['loggedin']) and $_SESSION['admin'] == '1'))
    {
        die();
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
<form method="post" action="adminuserinsert.php">
<tr><td>Date of birth</td><td><input type="text" name="dob" id="datepicker"></td></tr>
<tr><td>First Name</td><td><input type="text" name="namefirst"></td></tr>
<tr><td>Second Name</td><td><input type="text" name="namesecond"></td></tr>
<tr><td>Email</td><td><input type="text" name="email"></td></tr>
<tr><td>Admin</td><td><input type="checkbox" name="admin"></td></tr>
<tr><td>Password</td><td><input type="password" name="password"></td></tr>
<tr><td><input type="submit" value="Submit"></td>
</form>
<form action="../adminuser.php">
<td><input type="submit" value="Cancel"></td>
</form></tr>
</table>
</body>
</html>
