<?php

require_once "config.php";
require_once "parsegrade.php";
require_once "APT.php";

// print_r($CFG->tool_folders);

use \Tsugi\Core\LTIX;

//$PDOX = LTIX::getConnection();
$LAUNCH = LTIX::session_start();

$doc = '<html><head><title>APT: bmi</title>
<link rel="stylesheet" type="text/css" href="topstyle.css">
<style type="text/css"></style></head><body bgcolor="#ffffff" text="#000000">

<b>Problem</b>: bmi<br>
<b>Language</b>: python<br>
<b>Files</b>: BMI.py<br>Number of APT runs this session is: 3<p>user is: anonymous user</p><p></p><p>upload ok, files moved: BMI.py
</p><p>Compiling...</p><p>compile succeeded</p><p><b>Program running:</b> standard output below</p><p>(if you don\'t see output immediately, wait ... your<br>code may have time-limit exceeded problems)<br></p><hr><pre></pre><hr><p>
<b>Test Results Follow (scroll to see all)</b></p><p><p>
<!-- ALLPASS_XYZ --></p><p>
# of correct: 4 out of 4
</p><table class="border" <tr=""><tbody><tr><td class="count">1</td><td class="pass">pass</td></tr>
<tr><td class="count">2</td><td class="pass">pass</td></tr>
<tr><td class="count">3</td><td class="pass">pass</td></tr>
<tr><td class="count">4</td><td class="pass">pass</td></tr>
<!--PERC:1.0000 --><tr><td class="count">1</td><td class="pass">pass</td><td>got<br><pre> 39.0594166667</pre>: 200.0 60.0 </td>
</tr><tr><td class="count">2</td><td class="pass">pass</td><td>got<br><pre> 23.0559056713</pre>: 170.0 72.0 </td>
</tr><tr><td class="count">3</td><td class="pass">pass</td><td>got<br><pre> 17.2180285714</pre>: 120.0 70.0 </td>
</tr><tr><td class="count">4</td><td class="pass">pass</td><td>got<br><pre> 62.5729352083</pre>: 250.0 53.0 </td>


</tr></tbody></table>
logged entry</p><p>
</p></body></html>
';

# Create grader object
$user = APT::getUser($doc);
$problem = APT::getProblem($doc);
$grade = APT::getGrade($doc);

echo('Problem: '.$problem.', grade: '.$grade.', user: '.$user);

?>
<html><head><title>Tsugi Sample Standalone Application</title></head>
<body style="font-family: sans-serif;">
<h1>Sample Standalone Application</h1>
<?php
    // Some flash messages...
    if ( isset($_SESSION["error"]) ) {
        echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
        unset($_SESSION["error"]);
    }
    if ( isset($_SESSION["success"]) ) {
        echo('<p style="color:green">'.$_SESSION["success"]."</p>\n");
        unset($_SESSION["success"]);
    }
?>
<p>
This is a sample Standalone application that uses Tsugi to add support
for logging in.  Here are some things you can do:
<ul>
<li>Visit this file (index.php) to check the session information and see this cool list</li>
<li>Logout completely (LTI and locally) using <a href="logout.php">logout.php</a>
</li>
<li>Login locally using <a href="login.php">login.php</a></li>
<li>Visit a file that checks for local login and is completely unaware of LTI
<a href="unaware.php">unaware.php</a></li>
<li>Visit a file that expects LTI to be provisioned and uses the LTI info to send a grade
<a href="grade.php">grade.php</a></li>
<li>Send an LTI launch to this file (index.php)</li>
<li>Send an LTI launch to <a href="launch.php" target="_blank">launch.php</a> to effect a local login</li>
<?php if ( isset($LAUNCH->user) && !isset($_SESSION['user_email']) ) { ?>
<li>Since you <b>do</b> have LTI launch  in your session and <b>do not</b>
have local login data in your session,
you can navigate to <a href="launch.php" target="_blank">launch.php</a>
to effect a local login using LTI launch data
that is already in your session.</li>
<?php } ?>
</ul>
</p>
<p>
Current situation:
<ul>
<li>Local user email:
<?= isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '<span style="color:red">Not logged in</span>' ?></li>
<li>LTI user email:
<?= isset($LAUNCH->user) ? $LAUNCH->user->email : '<span style="color:red">No LTI Email Address</span>' ?></li>
<li>LTI user name:
<?= isset($LAUNCH->user) ? $LAUNCH->user->displayname : '<span style="color:red">No LTI Email user name</span>' ?></li>
</ul>

<h2>Dump of the LTI variables and session</h2>

<?php

echo("<pre>\n");
$LAUNCH->var_dump();
echo("</pre>\n");
?>
</body>
</html>
