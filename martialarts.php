<?php include 'scripts/base.php'; ?>
<html>
    <head>
        <title>Y/P/M/D</title>
        <meta charset="UTF-8">
        <meta name="keywords" content="Yoga, Pilates, Martial Arts, Dance, School, Karate, Tae Kwon Do">
        <meta name="description" content="Yoga/Pilates/Martial arts/Dance School">
        <meta name="author" content="Robert Stephens">
        <link rel="stylesheet" type="text/css" href="ypmd.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="scripts/ypmd.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <h1><a href="index.php">Y/P/M/D</a></h1>
                <div id="loginindicator">
                    <?php if(isset($_SESSION['loggedin'])){ ?>
                        you are logged in as <?php echo $_SESSION['firstname']; ?><br>
                        <a href="profile.php">Profile</a> <a href="scripts/logoutscript.php">Logout</a>
                    <?php } else { ?>
                        you are not logged in <br>
                        <a href="login.php">Login</a>
                    <?php } ?>
                </div>
                <table id="navTable">
                    <tr>
                        <td><a href="yoga.php"><div>Yoga</div></a></td>
                        <td><p>/</p></td>
                        <td><a href="pilates.php"><div>Pilates</div></a></td>
                        <td><p>/</p></td>
                        <td><a href="martialArts.php"><div>Martial Arts</div></a></td>
                        <td><p>/</p></td>
                        <td><a href="dance.php"><div>Dance</div></a></td>
                    </tr>
                </table>
            </div>
            <div id="content">
            <h2>Martial Arts</h2>
            <p>Martial arts are chiefly taught by master Chris Madeline</p>
            <h2>Classes</h2>
            <?php
                $conn=new mysqli("localhost","root","password","website");
                if ($conn->connect_error)
                {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT * FROM class WHERE discipline = 3";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc())
                {
                    echo "<table style=\"width:50%\">";
                    setlocale(LC_MONETARY, 'en_GB.UTF-8');
                    $gbp = money_format('%n',$row['price']);
                    $classid = $row['classid'];
                    echo "<tr style=\"font-weight:bold;\"><td>".$row['name']."</td><td>".$gbp."</td></tr>";    
                    echo "<tr><td colspan=2>".$row['description']."</td></tr>";
                    echo "</table>";

                    $conn2=new mysqli("localhost","root","password","website");
                    if ($conn2->connect_error)
                    {
                        die("Connection failed: " . $conn2->connect_error);
                    }
                    $imagesql = "SELECT * FROM images WHERE classid = ".$classid;
                    $imageresult = $conn2->query($imagesql);
                    if($imageresult->num_rows > 0)
                    {
                        echo "<img onclick=\"next".$classid."();return false;\" id=\"gallery".$classid."\"></img>";
                        echo "<script>";
                        echo "var images".$classid." = new Array();";
                        $i = 0;
                        while($imagerow = $imageresult->fetch_assoc())
                        {
                            //echo '<img src="data:image/jpeg;base64,'.base64_encode( $imagerow['image'] ).'"/>';
                            //echo "images".$classid."[".$i."]=".base64_encode( $imagerow['image'] ).";";
                            echo "images".$classid."[".$i."]= new Image();";
                            echo "images".$classid."[".$i."].src = \"data:image/jpeg;base64,".base64_encode( $imagerow['image'] )."\";"; 
                            $i++;
                        }
                        echo "var count".$classid."= 0;";
                        echo "function next".$classid."(){";
                        echo "count".$classid."++;";
                        echo "if(count".$classid." == images".$classid.".length) { count".$classid." = 0;}";
                        echo "document.getElementById(\"gallery".$classid."\").src=images".$classid."[count".$classid."].src;";
                        echo "}";
                        echo "document.getElementById(\"gallery".$classid."\").src=images".$classid."[0].src;";
                        echo "</script>";
                    }
                    $conn2->close();
                }

                $conn->close();
            ?>    
            </div>
            <div id="footer">
                <table id="footerTable">
                    <tr>
                        <td><a href="about.php"><div>About</div></a></td>
                        <td><a href="contact.php"><div>Contact</div></a></td>
                        <td><a href="login.php"><div>Login</div></a></td>
                        <td><a href="admin.php"><div>Admin</div></a></td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>
