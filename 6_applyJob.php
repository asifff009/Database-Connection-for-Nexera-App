<?php

$con = mysqli_connect("localhost", "root", "", "apply_job");

$name = $_GET['a'];
$interest = $_GET['b'];
$experience = $_GET['c'];
$skill = $_GET['d'];
$location = $_GET['e'];
$contact = $_GET['f'];

if(mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else{
    echo "Connected successfully to MySQL database.";
}

$sql = "INSERT INTO job_apply(name, interest, experience, skill, location, 
contact) VALUES('$name','$interest','$experience','$skill','$location',
'$contact')";
$result = mysqli_query($con, $sql);

if($result) {
    echo "Data inserted successfully.";
} else {
    echo "Error inserting data: " . mysqli_error($con);
}




?>
