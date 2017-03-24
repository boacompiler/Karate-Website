<?php
    include('base.php');
    $image = addslashes(file_get_contents($_FILES['fileToUpload']['tmp_name']));
    $classid = $_POST['classid'];
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = 'INSERT INTO images (image,classid) VALUES ("'.$image.'","'.$classid.'");';
    if($conn->query($sql))
    {
        header("Location: ".$_SESSION['page']);
    }
    else
    {
        echo 'Cannot Insert';
        echo '<br>'.$sql;
    }
    $conn->close();
?>
