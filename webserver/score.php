<?php

if (isset($_COOKIE['key'])) {
    $cookieValue = $_COOKIE['key'];
    $info = base64_decode($cookieValue);
    $info_data = explode("^", $info);
    $schoolcode = $info_data[0];
    $pass = $info_data[1];
    $team = $schoolcode;
}

$host = "localhost";
$user = "root";
$passwd = "155988";
$db = "infinity";
$conn = new mysqli($host, $user, $passwd, $db);

$auth = "SELECT password FROM users WHERE schoolcode = ?";
$stmt = $conn->prepare($auth);
$stmt->bind_param("s", $schoolcode); // "s" indicates the type of the parameter (string)
$stmt->execute();
$authres = $stmt->get_result();

// Check if there is a matching user
if ($authres->num_rows > 0) {
    // Fetch data from the result set
    $row = $authres->fetch_assoc();
    $password = $row['password'];
}
// Check connection
if ($conn->connect_error) {
    die(json_encode(array('error' => 'Connection failed: ' . $conn->connect_error)));
}

if (empty($team)) {
    die(json_encode(array('error' => 'Team code not provided')));
}

// Prepare statement to avoid SQL injection
$stmt = $conn->prepare("SELECT schoolcode, score, q1, q2, q3, q4, q5 FROM leaderboard WHERE schoolcode = ?");
$stmt->bind_param('s', $team);
$stmt->execute();
$result = $stmt->get_result();

$data = array();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = array(
        'schoolcode' => $row['schoolcode'],
        'q1' => "Not attempted",
        'q2' => "Not attempted",
        'q3' => "Not attempted",
        'q4' => "Not attempted",
        'q5' => "Not attempted",
    );
    if($row['q1'] != NULL){
        $data['q1'] = "Accepted";
    }
    if($row['q2'] != NULL){
        $data['q2'] = "Accepted";
    }
    if($row['q3'] != NULL){
        $data['q3'] = "Accepted";
    }
    if($row['q4'] != NULL){
        $data['q4'] = "Accepted";
    }
    if($row['q5'] != NULL){
        $data['q5'] = "Accepted";
    }

} else {
    $data['error'] = 'No results found';
}

echo json_encode($data);
$stmt->close();
$conn->close();

?>

