<?php
    //registers a new user
    include('base.php');
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password2=$_POST['password2'];
    $firstname=$_POST['firstname'];
    $secondname=$_POST['secondname'];
    $dob=$_POST['dob']; //date of birth
    if($email == '' or $password == '' or $password2 == '' or $firstname == '' or $secondname == '' or $dob == '')
    {
        //if any fields are blank, returns to registration page and displays an error
        $_SESSION['errorregister'] = 'Please complete all fields';
        header("Location: ../register.php");
    }
    elseif($password !== $password2)
    {
        //if repeated passwords do not match, returns to registration page and displays an error
        $_SESSION['errorregister'] = 'Passwords do not match';
        header("Location: ../register.php");
    }
    elseif(!preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}/',(string)$dob) or !checkdate((int)substr($dob, 5, 2),(int)substr($dob, 8, 2),(int)substr($dob, 0, 4))) 
    {
        //if the date is not numeric or not a real gregorian date, returns to registration page and displays an error

        $_SESSION['errorregister'] = 'Invalid date, please use the format yyyy-mm-dd';
        header("Location: ../register.php");
    }
    else
    {
        //attempts to register the user
        $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }
        $password = crypt($password, 'KYT5NfCA5nfnJYvbfeQAlw4b4ON02dfz');//encrypts password with salt
        $_email = mysqli_real_escape_string($conn,$email); //escape characters are added to strings to prevent sql injection
        $_password = mysqli_real_escape_string($conn,$password); 
        $_firstname = mysqli_real_escape_string($conn,$firstname); 
        $_secondname = mysqli_real_escape_string($conn,$secondname); 
        $_dob = mysqli_real_escape_string($conn,$dob); 
        $sql = "SELECT * FROM user WHERE email='$_email'";
        $checkemail = $conn->query($sql);
        if($checkemail->num_rows >= 1)
        {
            //if the email has already been used, returns to registration page and displays an error
            $_SESSION['errorregister'] = 'That email is already in use';
            header("Location: ../register.php");
        }
        else
        {
            $sql = "INSERT INTO `user` (`admin`, `namefirst`, `namesecond`, `email`, `password`, `dateofbirth`) VALUES ('0', '$_firstname', '$_secondname', '$_email', '$_password', '$_dob');";
            if( $conn->query($sql))
            {
                //if the registration completes, logs user in
                $sql = "SELECT * FROM user WHERE password='$_password' AND email='$_email'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                session_unset();
                $_SESSION['loggedin'] = 'true';
                $_SESSION['userid'] = $row['userid'];
                $_SESSION['admin'] = '0';
                $_SESSION['firstname'] = $firstname;
                $_SESSION['secondname'] = $secondname;
                $_SESSION['email'] = $email;
                $_SESSION['dob'] = $dob;
                header("Location: ../profile.php");
            }
            else
            {
                //if the registration fails, returns to registration page and displays an error
                $_SESSION['errorregister'] = 'Something went wrong, try again later';
                header("Location: ../register.php");
            }
        } 
        $conn->close();
    }
    die();
?>
