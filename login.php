<?php
    $LAUNCH = LTIX::session_start();

    session_start();
    if ( isset($_POST["user_email"]) && isset($_POST["pw"]) ) {
        unset($_SESSION["user_email"]);  // Logout current user
        if ( $_POST['pw'] == 'tsugi' ) {
            $_SESSION["user_email"] = $_POST["user_email"];
            $_SESSION["success"] = "Logged in.";
            header( 'Location: index.php' ) ;
            return;
        } else {
            $_SESSION["error"] = "Incorrect password.";
            header( 'Location: login.php' ) ;
            return;
        }
    }
?>
<html>
<head>
</head>
<body style="font-family: sans-serif;">
<h1>Please Log In</h1>
<?php
    if ( isset($_SESSION["error"]) ) {
        echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
        unset($_SESSION["error"]);
    }
    if ( isset($_SESSION["success"]) ) {
        echo('<p style="color:green">'.$_SESSION["success"]."</p>\n");
        unset($_SESSION["success"]);
    }
?>
<form method="post">
<p>Email Adress: <input type="text" name="user_email" value=""></p>
<p>Password: <input type="text" name="pw" value="tsugi"></p>
<p><input type="submit" value="Log In"></p>
</form>
</body>
