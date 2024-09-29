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

function getCommsEn(){
    $filename = "../admin/uyi7y8787tyguhjhg876/commsen.txt";    
    $fp = fopen($filename, "r");
    $contents = fread($fp, filesize($filename));
    fclose($fp);
    if ($contents == "yes"){
        return TRUE;
    }
    else{
        return FALSE;
    }
}

if(!getCommsEn()){
    echo "<html><body><h1><center>Comms disabled. </center></h1></body></html>";
    exit();
}
include '../admin/creds.php';
$conn = new mysqli($host, $user, $passwd, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the query using prepared statements
$auth = "SELECT password FROM volunteers WHERE name = ?";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel='stylesheet' href='style/main.css'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions Table</title>
    <script>
        // Fetch the data from the database every 500ms
        setInterval(fetchPicked, 500);

        function fetchPicked() {
            fetch('picked.php')
                .then(response => response.json())
                .then(data => {
                    const picked = document.getElementById("picked");

                    if (data.length > 0) {
                        // Assuming the first element has the picked question
                        picked.innerHTML = data[0].question;
                    } else {
                        picked.innerHTML = "No question picked.";
                    }
                })
                .catch(error => {
                    console.error('Error fetching picked question:', error);
                    picked.innerHTML = "Error loading picked question.";
                });
        }

        setInterval(fetchTableData, 500);
        function fetchTableData() {
            fetch('fetch_queries.php')
                .then(response => response.json())
                .then(data => {
                    const table = document.getElementById("queriesTableBody");
                    table.innerHTML = ""; // Clear existing rows

                    data.forEach(row => {
                        const newRow = document.createElement("tr");

                        const tcodeCell = document.createElement("td");
                        tcodeCell.textContent = row.tcode;
                        newRow.appendChild(tcodeCell);

                        const questionCell = document.createElement("td");
                        questionCell.textContent = row.question;
                        newRow.appendChild(questionCell);

                        const timeCell = document.createElement("td");
                        timeCell.textContent = row.time;
                        newRow.appendChild(timeCell);

                        const pickButtonCell = document.createElement("td");
                        const pickButton = document.createElement("button");
                        pickButton.textContent = "Pick";
                        pickButton.onclick = () => pickQuestion(row.tcode,row.question);
                        pickButtonCell.appendChild(pickButton);
                        newRow.appendChild(pickButtonCell);

                        table.appendChild(newRow);
                    });
                });
        }

        function pickQuestion(tcode,content) {
            const tcodecontainer = document.getElementById("tcode");
            const questioncontainer = document.getElementById("question");
            selectedTcode = tcode;
            tcodecontainer.value = tcode;
            response_content = content;
            questioncontainer.value = content;
            fetch('pick_question.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `tcode=${encodeURIComponent(tcode)}&content=${encodeURIComponent(content)}`
            }).then(() => {
                alert(`Picked question : ${content}`);
            });
        }

        function submitResponse() {
            const response_content = document.getElementById("question").value;
            const tcode = document.getElementById("tcode").value;
            const response = document.getElementById("response").value;
            if (selectedTcode.length == 0) {
                alert("Please pick a question first.");
                return;
            }
            if (response.length == 0) {
                alert("Please enter a response.");
                return;
            }
            if (response_content.length == 0) {
                alert("Please pick a question first.");
                return;
            }
            fetch('submit_response.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `content=${encodeURIComponent(response_content)}&tcode=${encodeURIComponent(selectedTcode)}&response=${encodeURIComponent(response)}`
            }).then(() => {
                alert("Response submitted.");
                document.getElementById("response").value = "";
            });
            document.getElementById("tcode").value = "";
            document.getElementById("question").value = "";
        }
    </script>
</head>
<body><center>
    <fieldset>
        <legend><h1>Support Page</h1></legend>
    <h1>Questions List</h1>
    <table border="1">
        <thead>
            <tr>
                <th>TCode</th>
                <th>Question</th>
                <th>Time</th>
                <th>Pick</th>
            </tr>
        </thead>
        <tbody id="queriesTableBody"></tbody>
    </table><br><br>
    <fieldset>
        <legend>picked question:</legend>
    <div id="picked"></div>
    </fieldset>
    <h2>Submit Response:</h2>
    <center>
    <input type='hidden' id='tcode'>
    <input type='hidden' id='question'>
    <textarea id="response" rows="4" cols="50" required></textarea>
    <br><br>
    <button id='submit' onclick="submitResponse()">Submit Response</button>
    </center>
    </fieldset>
    </center>
</body>
</html>
