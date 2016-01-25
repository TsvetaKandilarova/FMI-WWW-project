<?php
//config.php containt the $db connection object
include_once("config.php");

session_start(); //starts or resumes session bassed on a session identifier passed by a GET of POST

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //This function is used to create a legal SQL string that you can use in an SQL statement.
    //The given string is encoded to an escaped SQL string, taking into account the current character set of the connection.
    //That's why we pass the connection object
    $myusername = mysqli_real_escape_string($db, $_POST['username']);
    $mypassword = mysqli_real_escape_string($db, $_POST['password']);


    $sql = "SELECT id,firstName FROM admin WHERE username='$myusername' and passcode='$mypassword'";
    //Query the DB
    $result = mysqli_query($db, $sql); // returns a mysqli_result object for SELECT, SHOW, DESCRIBE or EXPLAIN, false on fail and true otherwise
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC); //Returns an array of strings that corresponds to the fetched row or NULL
    //if there are no more rows in resultset.Fetched result row is an associative array.
    $active = $row['active'];

    $count = mysqli_num_rows($result);

    //if the user is registered- e.g. there are rows in the resultSet
    if ($count == 1) {
        //$_SESSION is an associative array containing session variables available to the current script.
        //This adds the username and name of the logged in user to the $_SESSION array
        $_SESSION['login_user'] = $myusername;
        $_SESSION['firstName'] = $row['firstName'];
        //this redirects the browser to index.php
        header("location: index.php");
    } else {
        $error = "Your Login Name or Password is invalid";
    }
}
?>

<!DOCTYPE html PUBLIC>
<html>
<head>
    <!--Metadata about the page-->
    <meta charset="UTF8"/>
    <!--Loading external stylesheet-->
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Login Page</title>
</head>

<body bgcolor="#FFFFFF">
<header>
    <!--Put the navigation on the side-->
    <?php include "nav.php" ?>

</header>

<div class="login">
    <h1 id="header">Login Page</h1>
    <form action="" method="post">
        <!--The action is empty thus the current page will be executed, the metod of submitting the form is post-->
        <label>User Name:</label><input type="text" name="username" class="box"/><br/><br/>
        <label>Password:</label><input type="password" name="password" class="box"/><br/><br/>
        <input type="submit" value=" Submit "/><br/>
    </form>
</div>

<div class="error"><?php if (isset($error) && $error) {
        echo $error;
    } ?></div>
</div> <!--section-->
</div>
</div>
<?php include "footer.php" ?>
</body>
</html>
