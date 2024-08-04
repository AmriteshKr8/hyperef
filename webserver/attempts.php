<?php
include 'creds.php';
$conn = new mysqli($host, $user, $passwd, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the number of questions from the query parameter
$numQuestions = isset($_GET['numQuestions']) ? intval($_GET['numQuestions']) : 0;

// Prepare an array to hold the results
$out = [];

// Query for each question based on the number
for ($i = 1; $i <= $numQuestions; $i++) {
    // Prepare the SQL query dynamically
    $entries_read = $conn->prepare("SELECT COUNT(*) AS attempts FROM submissions WHERE question = ?");
    $entries_read->bind_param("i", $i);
    $entries_read->execute();
    $result = $entries_read->get_result();
    
    // Fetch the result
    $row = $result->fetch_assoc();
    $out['qa' . $i] = $row['attempts'];
    
    // Close the statement
    $entries_read->close();
}

// Encode the result as JSON and output it
header('Content-Type: application/json');
echo json_encode($out);

// Close the database connection
$conn->close();
?>
