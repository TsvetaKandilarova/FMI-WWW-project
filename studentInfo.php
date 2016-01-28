<?php
header('Access-Control-Allow-Origin: *');
require "./config.php";
$top = !empty($_GET["fn"]) ? intval($_GET["fn"]) : 909;

try {
    $conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = $conn->prepare("SELECT * FROM students where fn = $top");
    $query->execute();

    $query1 = $conn->prepare("SELECT * FROM result where fn = $top order by onDate desc");
    $query1->execute();

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
$conn = null;
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