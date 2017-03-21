<?php include 'scripts/base.php'; ?>
<html>
    <head>
        <title>Y/P/M/D</title>
        <meta charset="UTF-8">
        <meta name="keywords" content="Yoga, Pilates, Martial Arts, Dance, School, Karate, Tae Kwon Do">
        <meta name="description" content="Yoga/Pilates/Martial arts/Dance School">
        <meta name="author" content="Robert Stephens">
        <link rel="stylesheet" type="text/css" href="ypmd.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js">
        <script src="scripts/ypmd.js"></script>
        <script>
            $(function() {
                $( "#datepicker" ).datepicker({dateFormat: "yy-mm-dd"}).val(); 
            } );
        </script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <h1>Y/P/M/D</h1>
                <table id="navTable">
                    <tr>
                        <td><a href="yoga.html"><div>Yoga</div></a></td>
                        <td><p>/</p></td>
                        <td><a href="pilates.html"><div>Pilates</div></a></td>
                        <td><p>/</p></td>
                        <td><a href="martialArts.html"><div>Martial Arts</div></a></td>
                        <td><p>/</p></td>
                        <td><a href="dance.html"><div>Dance</div></a></td>
                    </tr>
                </table>
            </div>
            <div id="content">
                <?php if(isset($_SESSION['errorregister'])){ echo "<p style=\"color:red;\">".$_SESSION['errorregister']."</p>"; unset($_SESSION['errorregister']); } ?>
                <form method="post" action="scripts/registerscript.php">
                    <table>
                        <tr>
                            <td>Email:</td>
                            <td><input type="email" name="email"></td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input type="password" name="password"></td>
                        </tr>
                        <tr>
                            <td>First Name:</td>
                            <td><input type="text" name="firstname"></td>
                        </tr>
                        <tr>
                            <td>Second Name:</td>
                            <td><input type="text" name="secondname"></td>
                        </tr>
                        <tr>
                            <td>Date of Birth:</td>
                            <td><input type="text" name="dob" id="datepicker"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div id="footer">
                <table id="footerTable">
                    <tr>
                        <td><a href="about.html"><div>About</div></a></td>
                        <td><a href="contact.html"><div>Contact</div></a></td>
                        <td><a href="login.php"><div>Login</div></a></td>
                        <td><a href="admin.html"><div>Admin</div></a></td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>
