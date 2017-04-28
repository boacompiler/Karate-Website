<?php
    //allows a user with correct email and password to log in
    include('base.php');
    $email=mysql_real_escape_string($_POST['email']); //real escape strings prevent against sql injection
    $password=mysql_real_escape_string($_POST['password']);
    $password=crypt($password, 'KYT5NfCA5nfnJYvbfeQAlw4b4ON02dfz');//encrypts password with salt
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM user WHERE password='$password' AND email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) 
    {
        //if a row matching the encrypted password and email, the credentials are correct
        $row = $result->fetch_assoc();
        session_unset();
        $_SESSION['loggedin'] = 'true';  
        $_SESSION['userid'] = $row['userid'];
        $_SESSION['admin'] = $row['admin'];
        $_SESSION['firstname'] = $row['namefirst'];
        $_SESSION['secondname'] = $row['namesecond'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['dob'] = $row['dateofbirth'];
        header("Location: ../profile.php");
    }
    else
    {
        //returns user to login page and displays an error
        $_SESSION['errorlogin'] = 'email or password are incorrect';
        header("Location: ../login.php");
    }
    $conn->close();
    die();
?> 
