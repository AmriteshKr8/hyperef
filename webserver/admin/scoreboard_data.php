<?php
include 'auth_admin.php';
include 'creds.php';
$conn = new mysqli($host, $user, $passwd, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the number of questions
$sql = "select id from questions";
$result = $conn->query($sql);
$qno = $result->num_rows;

// Generate the table header
echo '<table border="1">';
echo '<tr>
<th>School</th>
<th>Score</th>';
for ($z = 1; $z <= $qno; $z++) {
    echo '<th>Q' . $z . '</th>';
}
echo '</tr>';

// Get the school codes and their total scores
$sql = "SELECT schoolcode, SUM(score) AS total_score FROM submissions WHERE schoolcode != 'system' GROUP BY schoolcode";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td>' . $row['schoolcode'] . '</td>';
    echo '<td>' . $row['total_score'] . '</td>';
    
    // Fetch the scores for each question for the current school
    $schoolcode = $row['schoolcode'];
    $scores_sql = "SELECT question, score FROM submissions WHERE schoolcode = '$schoolcode'";
    $scores_result = $conn->query($scores_sql);
    
    $scores = array();
    while ($scores_row = $scores_result->fetch_assoc()) {
        $scores[$scores_row['question']] = $scores_row['score'];
    }

    for ($z = 1; $z <= $qno; $z++) {
        if (isset($scores[$z])) {
            echo '<td>' . $scores[$z] . '</td>';
        } else {
            echo '<td>0</td>'; // Assume 0 if there is no score for this question
        }
    }
    echo '</tr>';
}

echo '</table>';

$conn->close();
?>
