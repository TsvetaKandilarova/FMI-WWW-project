<?php header('Access-Control-Allow-Origin: *'); ?>
<?php

require "./config.php";
$fn = !empty($_GET["fn"]) ? $_GET["fn"] : "";


try {
    $conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = $conn->prepare("SELECT s.fn, s.first_name,s.groupNumber, s.last_name, s.major, sum(r.grade) as grade, s.last_name FROM students as s
        Right join result as r on s.fn = r.fn
        where s.fn = $fn
        GROUP BY s.fn
        order by sum(r.grade)");
    $query->execute();

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
$conn = null;


$result = array();
$count = 0;
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $result[$count++] = array(
        'fn' => $row['fn'],
        'groupNumber' => $row['groupNumber'],
        'name' => $row['first_name'],
        'lastName' => $row['last_name'],
        'major' => $row['major'],
        'last' => $row['last_name'],
        'grade' => $row['grade']
    );

}
echo json_encode($result);
?>