<?php
include 'auth_admin.php';
include 'creds.php';
$conn = new mysqli($host, $user, $passwd, $db);

$password = $_POST['password'];
$school_code = $_POST['school_code'];
$school = $_POST['school'];

$sql = "INSERT INTO users (password, schoolcode, school) VALUES (?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $password, $school_code,$school);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: ". $sql. "<br>". $conn->error;
}

$stmt->close();
$conn->close();
?>
