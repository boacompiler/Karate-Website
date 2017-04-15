<?php
    include('base.php');
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM class WHERE discipline = ".$discipline;
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc())
    {
        
        echo "<table style=\"width:100%\">";
        setlocale(LC_MONETARY, 'en_GB.UTF-8');
        $gbp = money_format('%n',$row['price']);
        $classid = $row['classid'];
        $userid = $_SESSION['userid'];

        $form = '';
        if(isset($_SESSION['loggedin']))
        {
            $booksql = "SELECT * FROM booking WHERE classid = '$classid' AND userid = '$userid'"; 
            $bookresult = $conn->query($booksql);

            $disable = '';

            if($bookresult->num_rows >= 1)
            {
                $disable = 'disabled="disabled"';
            }
            $form = "<form method=\"post\" action=\"scripts/signupscript.php\"><input type=\"hidden\" name=\"signupclassid\" value=\"".$classid."\"><input type=\"submit\" value=\"Sign Up\" ".$disable."></form>";
        }
        

        echo "<tr style=\"font-weight:bold;\"><td>".$row['name']."</td><td>".$gbp."</td><td>".$form."</td></tr>";    
        echo "<tr><td colspan=2>".$row['description']."</td></tr>";
        echo "</table>";

        $imagesql = "SELECT * FROM images WHERE classid = ".$classid;
        $imageresult = $conn->query($imagesql);
        if($imageresult->num_rows > 0)
        {
            echo "<img onclick=\"next".$classid."();return false;\" id=\"gallery".$classid."\" class=\"gallery\"></img>";
            echo "<script>";
            echo "var images".$classid." = new Array();";
            echo "var alts".$classid." = new Array();";
            $i = 0;
            while($imagerow = $imageresult->fetch_assoc())
            {
                //echo '<img src="data:image/jpeg;base64,'.base64_encode( $imagerow['image'] ).'"/>';
                //echo "images".$classid."[".$i."]=".base64_encode( $imagerow['image'] ).";";
                echo "images".$classid."[".$i."]= new Image();";
                echo "images".$classid."[".$i."].src = \"data:image/jpeg;base64,".base64_encode( $imagerow['image'] )."\";"; 
                echo "alts".$classid."[".$i."] = \"".$imagerow['description']."\";";
                $i++;
            }
            echo "var count".$classid."= 0;";
            echo "function next".$classid."(){";
            echo "count".$classid."++;";
            echo "if(count".$classid." == images".$classid.".length) { count".$classid." = 0;}";
            echo "document.getElementById(\"gallery".$classid."\").src=images".$classid."[count".$classid."].src;";
            echo "document.getElementById(\"gallery".$classid."\").alt=alts".$classid."[count".$classid."];";
            echo "}";
            echo "document.getElementById(\"gallery".$classid."\").src=images".$classid."[0].src;";
            echo "document.getElementById(\"gallery".$classid."\").alt=alts".$classid."[0];";
            echo "</script>";
        }
        if(isset($_SESSION['loggedin']) and $_SESSION['admin'] == '1')
        {
            echo '<form action="scripts/adminupload.php" method="post" enctype="multipart/form-data">'; 
            echo '<input type="hidden" name="classid" value="'.$classid.'">';
            echo '<input type="file" name="fileToUpload" id="fileToUpload">';
            echo '<input type="submit" value="Upload Image" name="submit">';
            echo '</form>';
        }
    }

    $conn->close();
?>    
