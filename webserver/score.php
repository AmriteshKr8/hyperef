<?php

if (isset($_COOKIE['key'])) {
    $cookieValue = $_COOKIE['key'];
    $info = base64_decode($cookieValue);
    $info_data = explode("^", $info);
    $schoolcode = $info_data[0];
    $pass = $info_data[1];
    $team = $schoolcode;
}

include 'creds.php';
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

$sql = "SELECT id FROM questions";
$result = $conn->query($sql);
$qno = $result->num_rows;

// Prepare statement to avoid SQL injection
$stmt = $conn->prepare("SELECT schoolcode, question FROM submissions WHERE schoolcode = ? GROUP BY question");
$stmt->bind_param('s', $team);
$stmt->execute();
$result = $stmt->get_result();

$data = array();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = array(
        'schoolcode' => $row['schoolcode'],
    );

    // Initialize all questions as not attempted
    for ($s = 1; $s <= $qno; $s++) {
        $data['q' . $s] = "NA";
    }

    // Update the data with the results from the database
    do {
        $data['q' . $row['question']] = "Accepted";
    } while ($row = $result->fetch_assoc());

} else {
    $data['error'] = 'No results found';
}

echo json_encode($data);
$stmt->close();
$conn->close();

?>
