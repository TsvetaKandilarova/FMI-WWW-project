<?php header('Access-Control-Allow-Origin: *'); ?>
<?php

require "./config.php";
$top = !empty($_GET["top"]) ? intval($_GET["top"]) : 5;
$class = !empty($_GET["classStudent"]) ? intval($_GET["classStudent"]) : date("Y");
$major = (!empty($_GET["major"]) && $_GET["major"] != "default") ? " AND s.major = '" . $_GET["major"] . "' " : "";
$groupNumber = (!empty($_GET["groupNumber"]) && $_GET["groupNumber"] != "default") ? "and s.groupNumber =" . intval($_GET["groupNumber"]) . " " : "";
$db = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
$sql = "SELECT s.fn, s.first_name,s.groupNumber, s.last_name, s.major, sum(r.grade) as grade, s.last_name FROM students as s
			Right join result as r on s.fn = r.fn
			where s.class = $class
			$major $groupNumber
			GROUP BY s.fn
			order by  sum(r.grade) desc limit $top";
$query = $db->query($sql) or die("failed!");

$result = array();
$count = 0;
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $result[$count++] = array('fn' => $row['fn'], 'groupNumber' => $row['groupNumber'], 'name' => $row['first_name'], 'lastName' => $row['last_name'], 'major' => $row['major'], 'last' => $row['last_name'], 'grade' => $row['grade']);

}
echo json_encode($result);


?>