<?php
    include('base.php');
    if(!(isset($_SESSION['loggedin']) and $_SESSION['admin'] == '1'))
    {
        die();
    }
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
    $_namefirst = mysqli_real_escape_string($conn,$namefirst);
    $_namesecond = mysqli_real_escape_string($conn,$namesecond);
    $_email= mysqli_real_escape_string($conn,$email);
    $_dob = mysqli_real_escape_string($conn,$dob);
    $_password= mysqli_real_escape_string($conn,$encryptedpassword);
    $_admin = 0;
    if($admin=="on") $_admin = 1;
    $sql="INSERT INTO `user`(`namefirst`, `namesecond`, `email`, `dateofbirth`, `admin`, `password`) VALUES ('$_namefirst','$_namesecond','$_email','$_dob','$_admin','$_password');";
    if($conn->query($sql))
    {
        header("Location: ../adminuser.php");
    }
    else
    {
        echo 'Cannot insert';
    }
    $conn->close();
?>
