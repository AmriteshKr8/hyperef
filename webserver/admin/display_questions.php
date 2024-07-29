<?php
include 'auth_admin.php';
include 'creds.php';
$conn = new mysqli($host, $user, $passwd, $db);

echo '<table border="1">';
echo '<tr><th>ID</th><th>Question</th><th>Score</th><th>Action</th></tr>';

$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td>'. $row['id']. '</td>';
    echo '<td>'. $row['question']. '</td>';
    echo '<td>'. $row['score']. '</td>';
    echo '<td><button class="delete-question-btn" value="'. $row['id']. '">Delete</button></td>';
    echo '</tr>';
}

echo '</table>';

$conn->close();
?>
