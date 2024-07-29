<?php
include 'auth_admin.php';
include 'creds.php';
$conn = new mysqli($host, $user, $passwd, $db);

$qno = $_POST['id'];
$inputs = $_POST['input'];
$output = $_POST['output'];

$sql = "INSERT INTO testcases (id, input, output) VALUES (?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $qno, $inputs, $output);

if ($stmt->execute()) {
    echo "New testcase added successfully";
} else {
    echo "Error: ". $sql. "<br>". $conn->error;
}

$stmt->close();
$conn->close();
?>
