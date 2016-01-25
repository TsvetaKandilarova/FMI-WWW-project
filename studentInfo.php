<?php
header('Access-Control-Allow-Origin: *');
require "./config.php";
$top = !empty($_GET["fn"]) ? intval($_GET["fn"]) : 909;
$db = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
$sql = "SELECT * FROM students where fn = $top";
$query = $db->query($sql) or die("failed!");
$sql_grade = "SELECT * FROM result where fn = $top order by onDate desc";
$query1 = $db->query($sql_grade) or die("failed!");
?>
<!DOCTYPE html>
<br/>
<?php
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    echo '<div class="studentInfo"><span>First Name: </span> <span>' . $row["first_name"] . ' </span><br>';

    echo "<span>Last Name: </span> <span>" . $row["last_name"] . "</span><br>";

    echo "<span>Id: </span> <span>" . $row["id"] . " </span><br>";

    echo "<span>Fn: </span> <span>" . $row["fn"] . " </span><br>";
    echo "<span>Last Update: </span><span>" . $row["last_updated"] . ' </span></div>';
}
echo "<table>";
echo '<tr><td>Grade</td><td>written For</td><td> written By</td><td>on date</tr></td>';
while ($row = $query1->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr><td>' . $row["grade"] . '</td><td>' . $row["writtenFor"] . '</td><td>' . $row["writtenBy"] . '</td><td>' . $row["onDate"] . '</tr></td>';

}
echo '</table>';
?>


