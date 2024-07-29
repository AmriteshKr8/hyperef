<?php
include 'auth_admin.php';
include 'creds.php';
$conn = new mysqli($host, $user, $passwd, $db);

$schoolcode = $_POST['schoolcode'];

$sql = "DELETE FROM users WHERE schoolcode=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $schoolcode);

if ($stmt->execute()) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: ". $stmt->error;
}

$stmt->close();
$conn->close();
?>
