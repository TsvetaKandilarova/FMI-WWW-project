<?php
include_once('config.php'); //get $db object
include_once("lock.php"); //check if we're logged/have access

if (count($_POST) > 0) //if we have varieables from a POST request
{
    if ($_POST['firstName'] == "" || $_POST['lastName'] == ""
        || $_POST['id'] == "" || $_POST['id'] < 0
        || $_POST['fn'] == "" || $_POST['fn'] < 0
        || $_POST['major'] == ""
        || $_POST['graduation'] == "" || $_POST['graduation'] < 0
        || $_POST['group'] == "" || $_POST['group'] < 0
    ) {
        //Log error if registration form is not full
        echo "<p class=\"failerror\">There is a problem with your registration!</p>";

    } else {
        //Get data from form
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $id = $_POST['id'];
        $fn = $_POST['fn'];
        $major = $_POST['major'];
        $graduation = $_POST['graduation'];
        $group = $_POST['group'];

        //Insert data into DB
        $sql = "insert into students(id, fn, first_name, last_name, major, class, groupNumber) values($id, $fn, '$firstName', '$lastName', '$major', $graduation, $group)";
        $result = mysqli_query($db, $sql); //will return true if successful
        //Insert a score of 0 for newly created student
        $sqlGrade = "insert into result(fn, grade) values ($fn, 0)";
        $resultGrade = mysqli_query($db, $sqlGrade); //will return true if successful

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF8">
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="css/registration.css"> <!--Load stylesheet-->
</head>

<body>
<header>
    <?php include "nav.php" ?> <!--Put navigation-->
</header>

<!--Form HTML-->

<div class="edit">
    <h1 id="header">Register a student</h1>
    
    <form method="post" action="">
        <!--Action is empty so the current page will be excuted e.g. the php above & metod is post-->
        <input type="text" placeholder="First Name" name="firstName" id="firstName" value="" class="box">
        <input type="text" placeholder="Last Name" name="lastName" id="lastName" value="" class="box">
        <input type="number" placeholder="Id" name="id" id="id" value="" class="box">
        <input type="fn" placeholder="Faculty Number" name="fn" id="fn" value="" class="box">
        <input type="number" placeholder="Year of Graduation" name="graduation" id="graduation" value="" class="box">
        <input type="number" placeholder="Administrive Group" name="group" id="group" value="" class="box">
        </br>
        <label>Major</label>
        </br>
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
        </br>
        </br>
        <input type="submit" value=" Submit "/><br/>
    </form>

    <?php
    //After posting form
    $method = $_SERVER['REQUEST_METHOD'];
    if (isset($result) && $result && isset($resultGrade) && $resultGrade) //if inserts in DB are successful
        echo "<p class=\"successmsg\">Student registered successfully!</p>";
    else if ($method == $_POST && !isset($result) || !$result || !isset($resultGrade) || !$resultGrade) { //THIS CHECK IS WRONG AND STUPID
        echo "<p class=\"failerror\">There was an error with registration!</p>";
    }
    ?>
</div>

<?php include "footer.php" ?>
</body>
</html>