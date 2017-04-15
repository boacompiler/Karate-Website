<?php
//script generates a table of class information and galleries for classes related to a discipline
//used on the discipline pages
    include('base.php');
    $userid = $_SESSION['userid'];
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    //select statement joins timeslot and users on class so we can gather all required information about class (including start time, duration and teacher
    $sql = "SELECT * FROM class c INNER JOIN user u ON c.teacher = u.userid INNER JOIN timeslot t ON c.timeslot = t.timeslotid WHERE discipline = ".$discipline;
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc())
    {
        //loops through every available class for the given discipline, outputing a table and gallery
        echo "<table style=\"width:100%\">";
        setlocale(LC_MONETARY, 'en_GB.UTF-8'); //sets the currency to gbp (£)
        $gbp = money_format('%n',$row['price']);
        $length = $row['timeend'] - $row['timebegin'];
        $classid = $row['classid'];

        $form = '';
        if(isset($_SESSION['loggedin']))
        {
            //if the user is logged in, generates a button to allow signing up for the class
            $booksql = "SELECT * FROM booking WHERE classid = '$classid' AND userid = '$userid'"; 
            $bookresult = $conn->query($booksql);

            $disable = '';

            if($bookresult->num_rows >= 1)
            {
                //disables button if user is already enroled
                $disable = 'disabled="disabled"';
            }
            $form = "<form method=\"post\" action=\"scripts/signupscript.php\"><input type=\"hidden\" name=\"signupclassid\" value=\"".$classid."\"><input type=\"submit\" value=\"Sign Up\" ".$disable."></form>";
        }

        echo "<tr style=\"font-weight:bold;\"><td>".$row['name']."</td><td>".$gbp."</td><td>".$form."</td></tr>";    
        echo "<tr><td>Start Time: ".substr($row['timebegin'], 0, -3);
        echo "<tr><td>Duration: ".$length." hours";
        echo "<tr><td colspan=2>".$row['description']."</td></tr>";
        echo "<tr><td>instructor: ".$row['namefirst']." ".$row['namesecond']."</td></tr>";
        echo "</table>";

        $imagesql = "SELECT * FROM images WHERE classid = ".$classid;
        $imageresult = $conn->query($imagesql);
        if($imageresult->num_rows > 0)
        {
            //if there are images relating to the class, generates a gallery
            //simple javascript for cycling the images is also generated 
            echo "<img onclick=\"next".$classid."();return false;\" id=\"gallery".$classid."\" class=\"gallery\"></img>";
            echo "<script>";
            echo "var images".$classid." = new Array();";
            echo "var alts".$classid." = new Array();";
            $i = 0;
            while($imagerow = $imageresult->fetch_assoc())
            {
                //loops through all images relating to the class, adding the image and alt text to arrays
                echo "images".$classid."[".$i."]= new Image();";
                echo "images".$classid."[".$i."].src = \"data:image/jpeg;base64,".base64_encode( $imagerow['image'] )."\";"; //images are retrieved as blobs and converted to Image objects
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
            //sets the initial image to display
            echo "document.getElementById(\"gallery".$classid."\").src=images".$classid."[0].src;";
            echo "document.getElementById(\"gallery".$classid."\").alt=alts".$classid."[0];";
            echo "</script>";
        }
        if(isset($_SESSION['loggedin']) and $_SESSION['admin'] == '1')
        {
            //if the user is an admin, generates an upload image button
            echo '<form action="scripts/adminupload.php" method="post" enctype="multipart/form-data">'; 
            echo '<input type="hidden" name="classid" value="'.$classid.'">';
            echo '<input type="file" name="fileToUpload" id="fileToUpload">';
            echo '<input type="submit" value="Upload Image" name="submit">';
            echo '</form>';
        }
    }

    $conn->close();
?>    
