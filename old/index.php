<?php
require_once "../../config.php";
require_once "APT.php";

use \Tsugi\Core\LTIX;
use \Tsugi\Grades\GradeUtil;

// Retrieve the launch data if present
$LTI = LTIX::requireData();
$p = $CFG->dbprefix;
$displayname = $USER->displayname;

// if grade was sent via post
if ( isset($_POST['grade']) )  {
    $user = APT::getUser($_POST['grade']);
    $problem = APT::getProblem($_POST['grade']);
    $grade = APT::getGrade($_POST['grade']);
    // list($id, $question, $grade) = APT::getInfo($_POST['grade']);
    // Make sure functions are working properly
    $_SESSION['error'] = $text = 'Problem: '.$problem.', grade: '.$grade.', user: '.$user;
    // convert grade to float
    $gradetosend = $grade + 0.0;
    // grade validation
    if ( $gradetosend < 0.0 || $gradetosend > 1.0 ) {
        $_SESSION['error'] = "Grade out of range";
		// Redirect back to same page
        header('Location: '.addSession('index.php'));
        return;
    }

    // TODO: Look in the $LINK Variable to find the previous grade
    // to make it so the grade never goes down unless the gradetosend
    // gradetosend is 0.0 - send the 0.0 to reset the grade.

    $prevgrade = $LINK->grade;

    // $prevgrade = 0.5;

    // if ( $gradetosend > 0.0 && $gradetosend < $prevgrade ) {
    //     $_SESSION['error'] = "Grade lower than $prevgrade - not sent";
    // } else {
    //     // Use LTIX to send the grade back to the LMS.
    //     $debug_log = array();
    //     $retval = LTIX::gradeSend($gradetosend, false, $debug_log);
    //     $_SESSION['debug_log'] = $debug_log;
    //
    //     if ( $retval === true ) {
    //         $_SESSION['success'] = "Grade $gradetosend sent to server.";
    //     } else if ( is_string($retval) ) {
    //         $_SESSION['error'] = "Grade not sent: ".$retval;
    //     } else {
    //         echo("<pre>\n");
    //         var_dump($retval);
    //         echo("</pre>\n");
    //         die();
    //     }
    // }

    // Redirect to ourself
    header('Location: '.addSession('index.php'));
    return;
}

// Start of the output
$OUTPUT->header();
$OUTPUT->bodyStart();
$OUTPUT->flashMessages();
// Don't change the line below - change the servicename in the configuration
echo("<h1>Tsugi Apt Autograder</h1>\n");
$OUTPUT->welcomeUserCourse();

echo("Input an structured HTML document to be parsed.");

?>
<form method="post">

<textarea name="grade" rows="8" cols="40"></textarea><br>
<input type="submit" name="send" value="Send grade">
</form>
<?php

if ( isset($_SESSION['debug_log']) ) {
    echo("<p>Debug output from grade send:</p>\n");
    $OUTPUT->dumpDebugArray($_SESSION['debug_log']);
    unset($_SESSION['debug_log']);
}

echo("\n<hr>\n<pre>Global Tsugi Objects:\n\n");
var_dump($USER);
var_dump($CONTEXT);
var_dump($LINK);

echo("\n<hr/>\n");
echo("Session data (low level):\n");
echo($OUTPUT->safe_var_dump($_SESSION));

$OUTPUT->footer();
