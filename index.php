<?php
include_once('lock.php'); //loads and executes lock.php, but unlike include if the file has been loaded it won't be executed again
$current_year = date("Y"); // returns the date
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF8"/>
    <script type="text/javascript" src="./js/jquery.min.js"></script>
    <script type="text/javascript" src="./js/nyroMolad.js"></script></script>
    <script type = "text/javascript" src = "./js/highcharts.js" ></script>
    <script type="text/javascript" src="./js/index.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css"> <!--Load the stylesheet-->
    <title> Home Page</title>
</head>
<body>
<header>
    <?php include "nav.php" ?> <!--Add navigation on the side-->

</header>

<div class="searchStudent">
    <h1>Students Info</h1>
    <div class="left">
        <label for="topStudent"> Select top Students </label>
        <select name="topStudent" id="topResult" class="box">
            <option value="1">1</option>
            <option value="5" selected>5</option>
            <option value="10">10</option>
            <option value="20">20</option>
        </select> </br>

        <label for="yearGr"> Year of graduate </label> <select name="yearGr" id="class_student" class="box">
            <?php
            for ($from = 0; $from < 4; $from++) {
                $selectedClass = ($from == 0) ? "selected" : "";
                echo '<option value="' . ($current_year + $from) . '" ' . $selectedClass . ' >' . ($current_year + $from - 1) . '/' . ($current_year + $from) . '</option>';
            }
            ?>
        </select></br>

        <label for="major"> Select major </label> <select name="major" id="major" class="box">
            <option value="default"></option>
            <option value="CS">Computer Science</option>
            <option value="SE">Software Engineering</option>
            <option value="INF">Informatics</option>
            <option value="INFMATH">Informatics and Mathematics</option>
            <option value="IS">Information Systems</option>
            <option value="MATH">Mathematics</option>
            <option value="APPMATH">Applied Mathematics</option>
            <option value="STAT">Statistics</option>
        </select></br>

        <label for="groupNumber"> Select group number</label>
        <select name="groupNumber" id="groupNumber" class="box">
            <option value="default"></option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select>

        <!--Ugh...-->
        </label></br>
        <a class="search" href="#"> <!-- href="#" should go to top of page, but magic: This very particular form of link will do nothing,
             and yet still qualify as a valid hyper-reference,
             so you can attach JavaScript event listeners to it.-->
            Search
        </a>

    </div>
    <div class="right">
        <label> Search by Faculty Number </label></br>
        <input class="fn" value="" type="number">
        <button class="searchByFN"> Search</button>
    </div>

</div>
<div class="test"></div>

<div id="container"></div>

<?php include "footer.php" ?>
</body>
</html>


<script type="text/javascript"> //WTF? :?
    // A page can't be manipulated safely until the document is "ready."
    // jQuery detects this state of readiness for you. Code included inside $( document ).ready()
    // will only run once the page Document Object Model (DOM) is ready for JavaScript code to execute.
    $(document).ready(function () {
        c = new app(<?php echo ($isLogged) ? 'true' : 'false'; ?>);
        c.init();
    });
</script>
