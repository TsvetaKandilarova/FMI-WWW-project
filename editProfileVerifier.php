<?php
include_once('config.php'); //db connection
include_once('lock.php'); //authentication and permissions

$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
    $id = $_POST['id'];
    $sql = "select count(id) from students where id = '$id'";
    $result = mysqli_query($db, $sql); //Search in DB for Student

    //I DON'T LIKE THIS,BUT MAYBE IT'S OK
    while ($row = mysqli_fetch_assoc($result)) { //WHY WHILE?
        $records = $row['count(id)']; //0 or 1
    }

    if ($records == 0) {  //If there are no records for Student with ID
        echo "<p class=\"nosuch\">There is no such student.</p>";
    } else if ($records == 1) { //If we find the student
        $newURL = "./editProfile.php";
        header('Location: ' . $newURL . '?identificator=' . $id); //Redirect to edit page for the student with selected id
    } else echo "<p class=\"failerror\">There seems to be a problem with this id.</p>"; //Fail otherwise
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF8">
    <link rel="stylesheet" type="text/css" href="css/editProfileVerifier.css"> <!--The stylesheet for the page-->
</head>

<body>
<header>
    <?php include "nav.php" ?> <!--Put in the navigation-->
    <title>Search Student</title>
</header>
<h1>Search Student</h1>
<h3> Enter a student's id: </h3>
<form method="post" action=""> <!--Action empty so we'll execute the current page on submit a.k.a. the php above-->
    <label for="id">ID: </label> <input type="number" name="id" id="id" value="">
    <button type="submit">Search</button>

    <br/>
</form>

<?php include "footer.php" ?>
</body>

</html>

