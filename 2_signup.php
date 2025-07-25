<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "user_system");

if ($conn->connect_error) {
    echo json_encode(["status" => "fail", "message" => "Database connection failed"]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "fail", "message" => "Invalid request method."]);
    exit();
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$user_type = $_POST['user_type'] ?? '';

if (empty($email) || empty($password) || empty($user_type)) {
    echo json_encode(["status" => "fail", "message" => "Missing parameters."]);
    exit();
}

$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(["status" => "exist", "message" => "User already exists"]);
    $stmt->close();
    $conn->close();
    exit();
}
$stmt->close();

$insert = $conn->prepare("INSERT INTO users (email, password, user_type) VALUES (?, ?, ?)");
$insert->bind_param("sss", $email, $password, $user_type);

if ($insert->execute()) {
    echo json_encode(["status" => "success", "message" => "User registered"]);
} else {
    echo json_encode(["status" => "fail", "message" => "Insert failed"]);
}

$insert->close();
$conn->close();
?>
