<?php
//Determine if we're logged in
$toLogOut = (isset($isLogged) && $isLogged && isset($_SESSION['firstName'])); //isSet checks only if var exists and has value, then we check if it's true
?>

<header>
</header>
<nav>
		   <span>Welcome<?php if ($toLogOut) echo(", {$_SESSION['firstName']}!");
               else echo "!"; ?>  </span> <!--If we're logged we're grated by name, otherwise just "Student"-->
   <span class="menu"> Menu </span>
    <ul id="menu" clear=left>
        <!--<li> Menu </li>-->
        <li><a href="index.php">Home Page</a></li>
        <li><?php if (!$toLogOut) //If we're not logged in second bullet is login, otherwise is logout
                echo '<a href="login.php">Login</a>';
            else echo '<a href="logout.php">Log out</a>';
            ?>
        </li>
        <?php if ($toLogOut) //If we're logged in we have the options to register and edit students
            echo '<li><a href="registration.php">Register new student</a></li>
							<li><a href="editProfileVerifier.php"> Edit student profile</a></li>';
        ?>
        </li>
    </ul>
</nav>
<link rel="stylesheet" type="text/css" href="css/nav.css"> <!--The stylesheet-->