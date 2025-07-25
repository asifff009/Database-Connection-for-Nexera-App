<?php

header('Content-Type: application/json; charset=utf-8');
$con = mysqli_connect("localhost", "root", "", "apply_job");

$sql = "SELECT * FROM job_apply";
$result = mysqli_query($con, $sql);

$data = array();

foreach($result as $singleRow){
    $name = $singleRow['name'];
    $interest = $singleRow['interest'];
    $experience = $singleRow['experience'];
    $skill = $singleRow['skill'];
    $location = $singleRow['location'];
    $contact = $singleRow['contact'];

    $userInfo['name'] = $name;
    $userInfo['interest'] = $interest;
    $userInfo['experience'] = $experience;
    $userInfo['skill'] = $skill;
    $userInfo['location'] = $location;
    $userInfo['contact'] = $contact;

    array_push($data, $userInfo);
}

echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);



?>
