<?php
include '../admin/creds.php';

$tcode = $_POST['tcode'];
$content = $_POST['content'];
if (isset($_COOKIE['key'])) {
    $cookieValue = $_COOKIE['key'];
    $info = base64_decode($cookieValue);
    $info_data = explode("^", $info);
    $name = $info_data[0];
    $pass = $info_data[1];
} else {
    header('Location: login.php');
    exit();
}
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE queries SET pickedby = ? WHERE tcode = ? and question = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $tcode, $content);

if ($stmt->execute()) {
    echo "Success";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
