<?php
include __DIR__ . '/../../config-db.php';

// fetching the city table's data
$id = $_POST['id'];
$sql =  "SELECT * FROM `accommodation` WHERE `owner_id` = $id;";
$result = mysqli_query($conn, $sql);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $accId = intval($row['accommodation_id']);
    $name = ucwords(strtolower($row['accommodation_name']));
    $acctype = ucwords(strtolower($row['accommodation_type']));
    $add = ucwords(strtolower($row['street_address'])) . ", " . ucwords(strtolower($row['locality'])) . ", " . ucwords(strtolower($row['location'])) . ", " . $row['pincode'];
    $googleLink = $row['google_map_link'];
    $streetAdd = ucwords(strtolower($row['street_address']));
    $locality = $row['locality'];
    $location = $row['location'];
    $pincode= $row['pincode'];
    $imgCount = $row['img_count'];
    $accDesc = ucfirst(strtolower($row['accommodation_description']));
    $amenities = explode(',', $row['amenities']);
    $accFor = ucwords(strtolower($row['accommodation_for']));

    $roomSQL = "SELECT * FROM `rooms` WHERE accommodation_id = $accId;";
        $roomResult = mysqli_query($conn, $roomSQL);
        $roomNumber = 1;
        if($roomResult && mysqli_num_rows($roomResult) > 0){
            while($row = mysqli_fetch_assoc($roomResult)){
                $roomID = intval($row['room_id']);
                $accomodationID = intval($row['accommodation_id']);
                $ownerID = intval($row['owner_id']);
                $rent = intval($row['rent']);
                $roomSize = intval($row['room_size']);
                $bedCount = intval($row['bed_count']);
                $occupiedBeds = intval($row['occupied_beds']);
                $extras = explode(",", $row['extras']);
                $tags = explode(",", $row['tags']);
                $roomImage = ($row['room_image']);

                $rooms[] = [
                    "roomID" => $roomID,
                    "accomodationID" => $accomodationID,
                    "ownerID" => $ownerID,
                    "rent" => $rent,
                    "roomSize" => $roomSize,
                    "bedCount" => $bedCount,
                    "occupiedBeds" => $occupiedBeds,
                    "extras" => $extras,
                    "tags" => $tags,
                    "roomImage" => $roomImage,
                ];
            }}

    $data[] = [
        "accommodation_id" => $accId,
        "accommodation_name" => $name,
        "accommodation_type" => $acctype,
        "address" => $add,
        "google_map_link" => $googleLink,
        "img_count" => $imgCount,
        "accommodation_description" => $accDesc,
        "amenities" => $amenities,
        "rooms" => $rooms,
        "streetAdd" => $streetAdd,
        "location" => $location,
        "locality" => $locality,
        "pincode" => $pincode,
        "accFor" => $accFor
    ];

}

$json = json_encode($data);

header("Content-Type: application/json");
echo json_encode($data);
?>