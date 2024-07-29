<?php
include 'auth_admin.php';
include 'creds.php';
$conn = new mysqli($host, $user, $passwd, $db);

echo '<table border="1">';
echo '<tr><th>Password</th><th>Schoolcode</th><th>School</th></tr>';

$sql = "SELECT password, schoolcode, school FROM users";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td>'. $row['schoolcode']. '</td>';
    echo '<td>'. $row['password']. '</td>';
    echo '<td>'. $row['school']. '</td>';
    echo '<td><button class="delete-btn" value="'. $row['schoolcode']. '">Delete</button></td>';
    echo '</tr>';
}

echo '</table>';

$conn->close();
?>
