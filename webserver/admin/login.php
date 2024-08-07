<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
<center>
<fieldset id="login">
<legend><h3><font id="login-heading">Login</font></h3></legend>
<form action="" method="post"> <!-- Changed action to "" since the PHP script is in the same file -->
    <div id="login-input">Username:</div> <input id="login-input-text" type="text" name="name"><br>
    <div id="login-input">Password:</div> <input id="login-input-text" type="password" name="password"><br>
    <input type="submit" value="Submit">
</form>
</fieldset>
</center>
</body>
</html>

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
        $error_message = "incorrect credentials";
        echo "
        <center>
        <br><br><fieldset id='errbox'><err>".$error_message."</err></fieldset>
        </center>
        ";
    }
}

$conn->close();
?>