<?php
include 'creds.php';
$conn = new mysqli($host, $user, $passwd, $db);

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $upassword = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM admins WHERE name =?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch data from the result set
        $row = $result->fetch_assoc();
        $password = $row['password'];
    }
    if ($upassword === $password) { // Use password_verify for comparison
        $dataToStore = base64_encode($name."^".$password);
        setcookie("key", $dataToStore);
        header('Location: index.php');
    }
    else{
        echo "incorrect credentials";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
<fieldset>
<legend><h3><font face="times new" color="black">Login</font></h3></legend>
<form action="" method="post"> <!-- Changed action to "" since the PHP script is in the same file -->
    <div>Username:</div> <input type="text" name="name"><br>
    <div>Password:</div> <input type="password" name="password"><br>
    <input type="submit" value="Submit">
</form>
</fieldset>
</body>
</html>