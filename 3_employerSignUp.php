<?php
// Enable error reporting (for debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set response header
header("Content-Type: text/plain");

// Database connection
$con = mysqli_connect("localhost", "root", "", "employer_signup");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get and sanitize POST data
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$companyname = trim($_POST['companyname'] ?? '');
$businesscategory = trim($_POST['businesscategory'] ?? '');
$regino = trim($_POST['regino'] ?? '');
$citystreet = trim($_POST['citystreet'] ?? '');
$password = trim($_POST['password'] ?? '');

// Check for missing fields
if (
    empty($name) || empty($email) || empty($companyname) ||
    empty($businesscategory) || empty($regino) || empty($citystreet) || empty($password)
) {
    echo "All fields are required.";
    mysqli_close($con);
    exit();
}

// Check if email already exists (prepared statement)
$checkQuery = "SELECT email FROM table_employer WHERE email = ?";
$stmt = mysqli_prepare($con, $checkQuery);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    echo "Email already exists! Try another email.";
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    exit();
}
mysqli_stmt_close($stmt);

// Hash the password securely
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert new employer
$insertQuery = "INSERT INTO table_employer (name, email, companyname, businesscategory, regino, citystreet, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($con, $insertQuery);
mysqli_stmt_bind_param($stmt, "sssssss", $name, $email, $companyname, $businesscategory, $regino, $citystreet, $hashedPassword);

if (mysqli_stmt_execute($stmt)) {
    echo "Signup Success!";
} else {
    echo "Signup Failed! " . mysqli_error($con);
}

mysqli_stmt_close($stmt);
mysqli_close($con);
?>
