<?php
include "db_connect.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT user_type FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "failure: SQL prepare error";
        exit();
    }

    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_type);
        $stmt->fetch();
        echo "success:" . $user_type;
    } else {
        echo "failure: invalid credentials";
    }

    $stmt->close();
    $conn->close();

} else {
    echo "failure: missing parameters. Received: " . json_encode($_POST);
}
?>
