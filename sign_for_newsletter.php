<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "23solutions";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['newsletter_email'] ?? '';
    $return_url = $_POST['return_url'] ?? '';

    $stmt_check_email = $conn->prepare("SELECT * FROM newsletters WHERE email = ?");
    $stmt_check_email->bind_param("s", $email);
    $stmt_check_email->execute();
    $result = $stmt_check_email->get_result();

    if ($result->num_rows > 0) {
        header("Location: $return_url?signed_successful=1#bottom");
        exit();
    } else {
        $stmt = $conn->prepare("INSERT INTO newsletters (email) VALUES (?)");
        $stmt->bind_param("s",  $email);

        if ($stmt->execute()) {
            header("Location: index.php?signed_successful=1#bottom");
            $stmt->close();
            exit();
        } else {
            header("Location: index.php?signed_error=1#bottom");
            $stmt->close();
            exit();
        }
    }

}

$conn->close();
?>