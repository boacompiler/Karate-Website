<?php
    session_start();
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password2=$_POST['password2'];
    $firstname=$_POST['firstname'];
    $secondname=$_POST['secondname'];
    $dob=$_POST['dob'];
    if($email == '' or $password == '' or $password2 == '' or $firstname == '' or $secondname == '' or $dob == '')
    {
        $_SESSION['errorregister'] = 'Please complete all fields';
        header("Location: /register.php");
    }
    elseif($password !== $password2)
    {
        $_SESSION['errorregister'] = 'Passwords do not match';
        header("Location: /register.php");
    }
    else
    {
        $conn=new mysqli("localhost","root","password","website"); 
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM user WHERE email='$email'";
        $checkemail = $conn->query($sql);
        if($checkemail->num_rows >= 1)
        {
            $_SESSION['errorregister'] = 'That email is already in use';
            header("Location: /register.php");
        }
        else
        {
            $password = crypt($password, 'KYT5NfCA5nfnJYvbfeQAlw4b4ON02dfz');
            $sql = "INSERT INTO `user` (`admin`, `namefirst`, `namesecond`, `email`, `password`, `dateofbirth`) VALUES ('0', '$firstname', '$secondname', '$email', '$password', '$dob');";
            if( $conn->query($sql))
            {
                session_unset();
                $_SESSION['loggedin'] = 'true';
                $_SESSION['admin'] = '0';
                $_SESSION['firstname'] = $firstname;
                $_SESSION['secondname'] = $secondname;
                $_SESSION['email'] = $email;
                $_SESSION['dob'] = $dob;
                header("Location: /profile.php");
            }
            else
            {
                $_SESSION['errorregister'] = 'Something went wrong, try again later';
                header("Location: /register.php");
            }
        } 
        $conn->close();
    }
    die();
?>
