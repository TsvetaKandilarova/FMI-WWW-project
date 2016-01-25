<?php
include_once('config.php'); //for the db connection
include_once("lock.php"); //authentication/authorization

$method = $_SERVER['REQUEST_METHOD'];

$id = $_GET['identificator'];
$updatedFields = array();
if (count($_POST) > 0) //If we have variables from POST method
{
    //We're updating each non-empty fiend and printing a message on success and error - obvious stuff
    //TODO add {} to if's they are ugly!!!
    if ($_POST['firstName'] != "") {
        $firstName = $_POST['firstName'];
        $sqlFirstName = "update students set first_name = '$firstName' where id=$id";
        $resultFirstName = mysqli_query($db, $sqlFirstName);
        if (isset($resultFirstName) && $resultFirstName) $updatedFields[0] = 'first name';
        else if (!$resultFirstName) echo "<p class=\"failerror\">There is a problem with updating this information!</p>";
    }
    if ($_POST['lastName'] != "") {
        $lastName = $_POST['lastName'];
        $sqlLastName = "update students set last_name = '$lastName' where id=$id";
        $resultLastName = mysqli_query($db, $sqlLastName);
        if (isset($resultLastName) && $resultLastName) $updatedFields[1] = 'last name';
        else if (!$resultFirstName) echo "<p class=\"failerror\">There is a problem with updating this information!</p>";
    }
    if ($_POST['major'] != "") {
        $major = $_POST['major'];
        $sqlMajor = "update students set major = '$major' where id=$id";
        $resultMajor = mysqli_query($db, $sqlMajor);
        if (isset($resultMajor) && $resultMajor) $updatedFields[2] = 'major';
        else if (!$resultFirstName) echo "<p class=\"failerror\">There is a problem with updating this information!</p>";
    }
    if ($_POST['graduation'] != "") {
        $graduation = $_POST['graduation'];
        $sqlGraduation = "update students set class = $graduation where id=$id";
        $resultGraduation = mysqli_query($db, $sqlGraduation);
        if (isset($resultGraduation) && $resultGraduation) $updatedFields[3] = 'graduation';
        else if (!$resultFirstName) echo "<p class=\"failerror\">There is a problem with updating this information!</p>";
    }
    if ($_POST['group'] != "") {
        $group = $_POST['group'];
        $sqlGroup = "update students set groupNumber = $group where id=$id";
        $resultGroup = mysqli_query($db, $sqlGroup);
        if (isset($resultGroup) && $resultGroup) $updatedFields[] = 'group';
        else if (!$resultFirstName) echo "<p class=\"failerror\">There is a problem with updating this information!</p>";
    }
    $successMessage = "Updated fields: ";
    foreach ($updatedFields as $upd) {
        if ($upd != "") $successMessage = $successMessage . $upd . '; ';
    }
    echo "<p class=\"successmsg\">$successMessage</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF8"/>
    <title>Edit Profile</title>
    <link rel="stylesheet" type="text/css" href="css/editProfile.css"> <!--Loading the stylesheet blah-->
</head>
<body>
<header>
    <?php include "nav.php" ?> <!--Adding the navigation-->
</header>

<h1 style="font-size: 30px"><strong>Edit Student's Profile</strong></h1>

<form id="form" method="post" action=""> <!--On submit: execute php above-->
    <label for="firstName"> First Name: </label> <input type="text" name="firstName" id="firstName" value="">
    <br/>
    <label for="lastName"> Last Name: </label> <input type="text" name="lastName" id="lastName" value="">
    <br/>
    <label for="major">Major: </label>
    <select name="major" id="major">
        <option value=""></option>
        <option value="CS">Computer Science</option>
        <option value="SE">Software Engineering</option>
        <option value="INF">Informatics</option>
        <option value="INFMATH">Informatics and Mathematics</option>
        <option value="IS">Information Systems</option>
        <option value="MATH">Mathematics</option>
        <option value="APPMATH">Applied Mathematics</option>
        <option value="STAT">Statistics</option>
    </select>
    <br/>
    <label for="graduation">Year of graduation: </label> <input type="number" name="graduation" id="graduation"
                                                                value="">
    <br/>
    <label for="group"> Administrative Group: </label> <input type="number" name="group" id="group" value="">
    <br/>
    <button type="submit">Edit Profile</button>
</form>

<?php include "footer.php" ?>
</body>
</html>