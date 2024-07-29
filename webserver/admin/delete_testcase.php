<?php
include 'auth_admin.php';
include 'creds.php';
$conn = new mysqli($host, $user, $passwd, $db);

$inp = $_POST['id'];
$idl = explode("%",$inp);
$id = $idl[1];
$input = $idl[0];
$sql = "DELETE FROM testcases WHERE id=? and input=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is",$id,$input);

if ($stmt->execute()) {
    echo "Testcase deleted successfully";
} else {
    echo "Error deleting testcase: ". $stmt->error;
}

$stmt->close();
$conn->close();
?>
