<?php
include_once('config.php'); //for the db connection
include_once("lock.php"); //authentication/authorization

$method = $_SERVER['REQUEST_METHOD'];

$id = $_GET['identificator'];
$updatedFields = array();
if (count($_POST) > 0) //If we have variables from POST method
{
    try {
        $conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_POST['firstName'] != "") {
            $firstName = $_POST['firstName'];

            $query = $conn->prepare("update students set first_name = '$firstName' where fn=$id");
            $resultFirstName = $query->execute();

            if (isset($resultFirstName) && $resultFirstName) {
                $updatedFields[0] = 'first name';
            } else if (!$resultFirstName) {
                echo "<p class=\"failerror\">There is a problem with updating this information!</p>";
            }
        }
        if ($_POST['lastName'] != "") {
            $lastName = $_POST['lastName'];

            $query = $conn->prepare("update students set last_name = '$lastName' where fn=$id");
            $resultLastName = $query->execute();

            if (isset($resultLastName) && $resultLastName) $updatedFields[1] = 'last name';
            else if (!$resultLastName) echo "<p class=\"failerror\">There is a problem with updating this information!</p>";
        }
        if ($_POST['major'] != "") {
            $major = $_POST['major'];

            $query = $conn->prepare("update students set major = '$major' where fn=$id");
            $resultMajor = $query->execute();

            if (isset($resultMajor) && $resultMajor) $updatedFields[2] = 'major';
            else if (!$resultMajor) echo "<p class=\"failerror\">There is a problem with updating this information!</p>";
        }
        if ($_POST['graduation'] != "") {
            $graduation = $_POST['graduation'];

            $query = $conn->prepare("update students set class = $graduation where fn=$id");
            $resultGraduation = $query->execute();

            if (isset($resultGraduation) && $resultGraduation) $updatedFields[3] = 'graduation';
            else if (!$resultGraduation) echo "<p class=\"failerror\">There is a problem with updating this information!</p>";
        }
        if ($_POST['group'] != "") {
            $group = $_POST['group'];

            $query = $conn->prepare("update students set groupNumber = $group where fn=$id");
            $resultGroup = $query->execute();

            if (isset($resultGroup) && $resultGroup) $updatedFields[] = 'group';
            else if (!$resultGroup) echo "<p class=\"failerror\">There is a problem with updating this information!</p>";
        }
        $successMessage = "Updated fields: ";
        foreach ($updatedFields as $upd) {
            if ($upd != "") $successMessage = $successMessage . $upd . '; ';
        }
        echo "<p class=\"successmsg\">$successMessage</p>";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
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

<div class="edit">
    <h1 id="header">Edit Student's Profile</h1>

    <form id="form" method="post" action=""> <!--On submit: execute php above-->
        <input type="text" placeholder="First Name" name="firstName" id="firstName" value="" class="box">
        <br/>
        <input type="text" placeholder="Last Name" name="lastName" id="lastName" value="" class="box">
        <br/>
        <input type="number" placeholder="Year of Graduation" name="graduation" id="graduation"
               value="" class="box">
        <input type="number" placeholder="Administrative Group" name="group" id="group" value="" class="box">
        </br>
        <label>Major</label>
        </br><select name="major" placeholder="Major" id="major" class="box">
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
        </br>
        </br>
        <input type="submit" value=" Submit "/><br/>
    </form>
</div>

<?php include "footer.php" ?>
</body>
</html>