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
                        <td><a href="martialarts.php"><div>Martial Arts</div></a></td>
                        <td><p>/</p></td>
                        <td><a href="dance.php"><div>Dance</div></a></td>
                    </tr>
                </table>
            </div>
            <div id="content">
                <h2>About Y/P/M/D</h2>
                <p>
                    YPMD is a multidisciplinary school for all abilities and interests!
                    Setup by Ruth and David Thompson over a year ago, celebrated martial artist Chris Madeline
                    now joins the staff to offer an ever increasing set of lessons.
                    We operate from the local school hall and offer competitive pricing.
                </p>
                <table id="stafftable">
                    <tr><td style="font-weight:bold;">Ruth Thomspon</td></tr>
                    <tr><td><img src="images/ruth.jpg" alt="ruth picture"></td><td>Ruth is passionate about yoga and pilates. She has studied yoga since she was 6 under the guidance of her mother, a world renowned practitioner. Ruth later expanded to pilates to combat arthritis. She is a founding member of YPMD. She has been married to David since 1998 and has 3 children. </td></tr>
                    <tr><td style="font-weight:bold;">David Thomspon</td></tr>
                    <tr><td><img src="images/david.jpg" alt="david picture"></td><td>David has always been a dancer, and has performed professionaly since the age of 7. He has appeared in productions of Coppelia, Don Quixote, Giselle and La Bayadere! He now teaches dance at University level, while also hosting informal improv classes for YPMD. He once met Baryshnikov. He is a founding member of YPMD. He is a loving father and husband.</td></tr>
                    <tr><td style="font-weight:bold;">Chris Madeline</td></tr>
                    <tr><td><img src="images/chris.jpg" alt="david picture"></td><td>Master Chris Madeline is a black belt in both karate and tae kwon do. Chris has practiced martial arts since he was 9 years old and is ranked in the top 20 martial artists in the country. He was runner up in the competition deciding olympic competitiors in 2007. He has joined YPMD to increase his class capacity and train students at the competitve level.</td></tr>
                </table>
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
