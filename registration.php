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
<h1>Register a student</h1>
<div class="registerStudent">
    <form method="post" action="">
        <!--Action is empty so the current page will be excuted e.g. the php above & metod is post-->
        <label for="firstName"> First Name: </label> <input type="text" name="firstName" id="firstName" value="">
        <br/>
        <label for="lastName"> Last Name: </label> <input type="text" name="lastName" id="lastName" value="">
        <br/>
        <label for="id">ID: </label> <input type="number" name="id" id="id" value="">
        <br/>
        <label for="fn">Faculty Number: </label> <input type="fn" name="fn" id="fn" value="">
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
        <button type="submit">Register</button>
    </form>

    <?php
    //After posting form
    $method = $_SERVER['REQUEST_METHOD'];
    if (isset($result) && $result && isset($resultGrade) && $resultGrade) //if inserts in DB are successful
        echo "<p class=\"successmsg\">Data inserted.</p>";
    else if ($method == $_POST && !isset($result) && !$result && !isset($resultGrade) && !$resultGrade) { //THIS CHECK IS WRONG AND STUPID
        echo "<p class=\"failerror\">Data not inserted!</p>";
    }
    ?>
</div>

<?php include "footer.php" ?>
</body>
</html>