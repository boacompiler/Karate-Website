<?php
    //script uploads an image to the database
    include('base.php');
    $image = addslashes(file_get_contents($_FILES['fileToUpload']['tmp_name']));
    $classid = $_POST['classid'];
    $altText = $_POST['altText'];
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = 'INSERT INTO images (image,description,classid) VALUES ("'.$image.'","'.$altText.'","'.$classid.'");';
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
