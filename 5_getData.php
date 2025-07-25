<?php

header('Content-Type: application/json; charset=utf-8');
$con = mysqli_connect("localhost", "root", "", "job_app");

$sql = "SELECT * FROM jobs";
$result = mysqli_query($con, $sql);

$data = array();

foreach($result as $singleRow){
    $title = $singleRow['title'];
    $description = $singleRow['description'];
    $experience = $singleRow['experience'];
    $duration = $singleRow['duration'];
    $location = $singleRow['location'];
    $contact = $singleRow['contact'];

    $userInfo['title'] = $title;
    $userInfo['description'] = $description;
    $userInfo['experience'] = $experience;
    $userInfo['duration'] = $duration;
    $userInfo['location'] = $location;
    $userInfo['contact'] = $contact;

    array_push($data, $userInfo);
}

echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);



?>
