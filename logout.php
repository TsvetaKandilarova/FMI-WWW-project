<?php
session_start(); //resumes the session 

//THIS DOES NOT DESTROY THE SESSION PROPERLY(we must detroy global variables and cookies) 
// SEE: http://php.net/manual/bg/function.session-destroy.php
if (session_destroy()) { // delete the session, but does not delete $_SESSION properties and cookies
    //true if successful
    header("Location: index.php");
}
?>