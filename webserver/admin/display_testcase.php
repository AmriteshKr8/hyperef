<?php
include 'auth_admin.php';
include 'creds.php';
$conn = new mysqli($host, $user, $passwd, $db);

echo '<table border="1">';
echo '<tr><th>Question</th><th>Inputs</th><th>Expected Output</th><th>Action</th></tr>';

$sql = "SELECT * FROM testcases";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td>'. $row['id']. '</td>';
    echo '<td>'. $row['input']. '</td>';
    echo '<td>'. $row['output']. '</td>';
    echo '<td><button class="delete-testcase-btn" value="'. $row['input']."%".$row['id'].'">Delete</button></td>';
    echo '</tr>';
}

echo '</table>';

$conn->close();
?>
