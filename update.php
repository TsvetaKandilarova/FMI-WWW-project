<?php
include_once('lock.php');
$fn = !empty($_GET["fn"]) ? intval($_GET["fn"]) : null;
$method = $_SERVER['REQUEST_METHOD'];
$writtenBy = $_SESSION['firstName'];
if ($method == 'POST') {
    $fn = $_POST['fn'];
    $grade = $_POST['grade'];
    $writtenFor = $_POST['writtenFor'];
    $writtenBy = $_SESSION['firstName'];
    $onDate = date("Y-m-d");
    if (isset($_POST['edit'])) {
        $sql_check = "SELECT *
				FROM result
				WHERE fn=$fn and writtenFor='$writtenFor' and writtenBy='$writtenBy'";
        $result_check = mysqli_query($db, $sql_check);
        if (mysqli_num_rows($result_check) > 0) {
            $sql = "UPDATE result
		SET grade=$grade, onDate='$onDate'
		WHERE fn=$fn and writtenFor='$writtenFor' and writtenBy='$writtenBy'";
            $result = mysqli_query($db, $sql);
        } else {
            $noTouple = true;
        }
    } else {
        $sql_check = "SELECT *
				FROM result
				WHERE fn=$fn and writtenFor='$writtenFor' and writtenBy='$writtenBy'";
        $result_check = mysqli_query($db, $sql_check);
        if (mysqli_num_rows($result_check) < 1) {
            $sql = "INSERT INTO result (fn, grade, writtenFor, writtenBy, onDate)
VALUES ($fn, $grade, '$writtenFor', '$writtenBy','$onDate')";
            $result = mysqli_query($db, $sql);
            echo "inserted";
        } else {
            $yesTouple = true;
        }

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF8"/>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/update.css">
</head>
<header>
    <?php include "nav.php" ?>
    <title> Update for student <?php echo $fn; ?> </title>
</header>
<body>
<h1>Update for student with fn: <?php echo $fn; ?></h1>
<h1>Teacher updating: <?php if (isset($writtenBy) && $writtenBy) {
        echo $writtenBy;
    } else echo "You don't belong here!"; ?> </h1>
<form action="update.php" method="post">
    <input type="hidden" name="fn" value="<?php print $fn; ?>"/>
    <label for="grade">Points:</label> <input class="grade" type="number" name="grade"><br>
    <label for="writtenFor">Written For:</label> <input class="writtenFor" type="text" name="writtenFor"><br>
    <label for="InsertorEdit">Do you want to Edit:</label>
    <input class="checkbox" type="checkbox" name="edit" value="">Edit<br>
    <input class="submit" type="submit">
    <p class="error hidden"> Please, enter all required information corectly.</p>
    <?php if (isset($result) && $result) echo "<p>All is right!</p>"; ?>
    <?php if (isset($noTouple) && $noTouple) echo "<p style='color: #FF0000;'>there is no such touple</p>"; ?>
    <?php if (isset($yesTouple) && $yesTouple) echo "<p style='color: #FF0000;'>there is such touple</p>"; ?>

</form>
<?php include "footer.php" ?>
</body>
</html>

<script type="text/javascript">
    jQuery(".submit").on("click", function () {
        if (jQuery(".grade").val() === "" || jQuery(".writtenFor").val() === "" || jQuery(".grade").val() < 0) {
            jQuery("p.error").removeClass("hidden");
            return false;
        }
    })

    jQuery(".grade, .writtenFor").on("click", function () {
        jQuery("p.error").addClass("hidden");
        return false;
    })
</script>
