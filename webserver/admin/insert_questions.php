<?php
include 'auth_admin.php';
include 'creds.php';
$conn = new mysqli($host, $user, $passwd, $db);

$qno = $_POST['qno'];
$question = $_POST['question'];
$score = $_POST['score'];

$sql = "INSERT INTO questions(id, question, score) VALUES (?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isi", $qno, $question, $score);

if ($stmt->execute()) {
    echo "New question added successfully";
} else {
    echo "Error: ". $sql. "<br>". $conn->error;
}

$stmt->close();
$conn->close();
?>
