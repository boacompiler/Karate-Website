<?php
    //updates a given user in the db
    include('base.php');
    if(!(isset($_SESSION['loggedin']) and $_SESSION['admin'] == '1'))
    {
        die();
    }
    $userid = $_POST['userid'];
    $namefirst = $_POST['namefirst'];
    $namesecond = $_POST['namesecond'];
    $email= $_POST['email'];
    $dob = $_POST['dob'];
    $admin = $_POST['admin'];
    $password = $_POST['password'];
    $encryptedpassword =crypt($password, 'KYT5NfCA5nfnJYvbfeQAlw4b4ON02dfz');//encrypts password with salt 
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    
    if($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    if(!preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}/',(string)$dob) or !checkdate((int)substr($dob, 5, 2),(int)substr($dob, 8, 2),(int)substr($dob, 0, 4)))
    {
        $_SESSION['erroruser'] = 'Invalid date, please use the format yyyy-mm-dd';
        header("Location: ../adminuser.php");
        die();
    }
    $_namefirst = mysqli_real_escape_string($conn,$namefirst);
    $_namesecond = mysqli_real_escape_string($conn,$namesecond);
    $_email= mysqli_real_escape_string($conn,$email);
    $_dob = mysqli_real_escape_string($conn,$dob);
    $_password= mysqli_real_escape_string($conn,$encryptedpassword);
    $_admin = 0;
    if($admin=="on") $_admin = 1;
    $passwordupdate = '';
    if($password !== '')
    {
        $passwordupdate = ", password = '$_password'";
    }
    $sql = "SELECT * FROM user WHERE email='$_email' AND NOT userid='$userid';";
    $checkemail = $conn->query($sql);
    if($checkemail->num_rows >= 1)
    {
        $_SESSION['erroruser'] = 'That email is already in use';
        header("Location: ../adminuser.php");
        die();
    }
    $sql="UPDATE user SET admin = '$_admin', namefirst = '$_namefirst', namesecond = '$_namesecond', email = '$_email', dateofbirth = '$_dob'".$passwordupdate." WHERE userid = '$userid';";
    if($conn->query($sql))
    {
        header("Location: ../adminuser.php");
    }
    else
    {
        echo 'Cannot update';
    }
    $conn->close();
?>
