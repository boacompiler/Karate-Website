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
            <h2>Time Slots</h2>
            <?php
                if(isset($_SESSION['errortime']))
                { 
                    echo "<p style=\"color:red;\">".$_SESSION['errortime']."</p>"; 
                    unset($_SESSION['errortime']); 
                }
                if(isset($_SESSION['loggedin']) and $_SESSION['admin'] == '1')
                {
                    include 'scripts/admintimetable.php';
                }
                else
                {
            ?>
            <p>You do not have administrator privileges.</p>
            <?php } ?>
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
