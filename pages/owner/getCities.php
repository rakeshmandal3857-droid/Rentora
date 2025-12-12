<?php
include __DIR__ . '/../../config-db.php';

// fetching the city table's data
$sql =  "SELECT * FROM `city`;";
$result = mysqli_query($conn, $sql);

$cityData = [];

while($row = mysqli_fetch_assoc($result)){
    $cityData[] = $row;
}

header("Content-Type: aplication/json");
echo json_encode($cityData);
?>