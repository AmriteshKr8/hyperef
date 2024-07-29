<?php
if (isset($_COOKIE['key'])) {
    $cookieValue = $_COOKIE['key'];
    $info = base64_decode($cookieValue);
    $info_data = explode("^", $info);
    $name = $info_data[0];
    $pass = $info_data[1];
} else {
    header('Location: login.php');
    exit();
}
include 'creds.php';
$conn = new mysqli($host, $user, $passwd, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the query using prepared statements
$auth = "SELECT password FROM admins WHERE name = ?";
$stmt = $conn->prepare($auth);
$stmt->bind_param("s", $name); // "s" indicates the type of the parameter (string)
$stmt->execute();
$authres = $stmt->get_result();

// Check if there is a matching user
if ($authres->num_rows > 0) {
    // Fetch data from the result set
    $row = $authres->fetch_assoc();
    $password = $row['password'];

    // Verify password
    if ($password === $pass) {
    } else {
        header('Location: login.php');
        exit();
    }
} else {
    // No user found with the provided email
    header('Location: login.php');
    exit();
}

// Close connection
$stmt->close();
$conn->close();
?>
