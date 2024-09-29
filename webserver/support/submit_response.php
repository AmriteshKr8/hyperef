<?php
include '../admin/creds.php';
$tcode = $_POST['tcode'];
$response = $_POST['response'];
$content = $_POST['content'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE queries SET response = ? WHERE tcode = ? and question = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $response, $tcode, $content);

if ($stmt->execute()) {
    echo "Success";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
