<?php

$con = mysqli_connect("localhost", "root", "", "job_app");

$title = $_GET['a'];
$description = $_GET['b'];
$experience = $_GET['c'];
$duration = $_GET['d'];
$location = $_GET['e'];
$contact = $_GET['f'];
$email = $_GET['g']; 

if(mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
    echo "Connected successfully to MySQL database.";
}

$sql = "INSERT INTO jobs(title, description, experience, duration, location, contact, email) 
        VALUES('$title','$description','$experience','$duration','$location','$contact', '$email')";
$result = mysqli_query($con, $sql);

if($result) {
    echo "Data inserted successfully.";
} else {
    echo "Error inserting data: " . mysqli_error($con);
}
?>
