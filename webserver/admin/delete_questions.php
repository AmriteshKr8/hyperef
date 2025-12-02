<?php
include 'auth_admin.php';
include 'creds.php';
$conn = new mysqli($host, $user, $passwd, $db);

$id = $_POST['id'];

$sql = "DELETE FROM questions WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Question deleted successfully";
} else {
    echo "Error deleting question: ". $stmt->error;
}

$stmt->close();
$conn->close();
?>
