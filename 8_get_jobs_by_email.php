<?php
$con = mysqli_connect("localhost", "root", "", "job_app");

$email = $_GET['email'];

$sql = "SELECT * FROM jobs WHERE email='$email'";
$result = mysqli_query($con, $sql);

$rows = array();

while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}

echo json_encode($rows);
?>
