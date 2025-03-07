<?php
$NAME = "HYPEREF"; //change this
$NAME_S = "H Y P E R E F"; //and this
$error_message = "";
function state(){
    $filename = "admin/uyi7y8787tyguhjhg876/test.txt";    
    $fp = fopen($filename, "r");
    $contents = fread($fp, filesize($filename));
    fclose($fp);
    if ($contents == "c2h1cnUgaG8gZ2F5YSBiZW5jaG8="){
        return TRUE;
    }
    else{
        return FALSE;
    }
}

function getMode(){
    $filename = "admin/uyi7y8787tyguhjhg876/format.txt";    
    $fp = fopen($filename, "r");
    $contents = fread($fp, filesize($filename));
    fclose($fp);
    if ($contents == "blitz"){
        return TRUE;
    }
    else{
        return FALSE;
    }
}

function getCommsEn(){
    $filename = "admin/uyi7y8787tyguhjhg876/commsen.txt";    
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

if (isset($_COOKIE['key'])) {
    $cookieValue = $_COOKIE['key'];
    $info = base64_decode($cookieValue);
    $info_data = explode("^", $info);
    $schoolcode = $info_data[0];
    $pass = $info_data[1];
} else {
    header('Location: login.html');
    exit();
}

if(state() === TRUE){

}
else{
    echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lobby</title>
    <style>
    body, html {
        height: 100%;
        margin: 0;
    }
    #vanta-bg {
        height: 100%;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        position: relative;
    }
    #spacer{
        border-width: 0;
        height:6vw;
        padding-bottom:3vh;
    }
    @font-face {
        font-family: "anurati";
        src: url("style/anurati.otf");
    }
    @font-face {
        font-family: "minecraft";
        src: url("style/minecraft.otf");
    }
    @font-face {
        font-family: "nasa";
        src: url("style/nasalisation.otf");
    }
    #heading{
        color:white;
        font-size:6vw;
        font-family:anurati;
    }
    #head{
        font-family:nasa;
        font-size:5vw;
        color:rgb(111, 0, 255);
    }
    ul {
        list-style: none;
        margin-left: 0;
        padding-top: 2vh;
        padding-left: 0;
    }

    li {
        padding-left: 1em;
        text-indent: -1em;
        font-size:30px;
        padding:20px;

    }

    li:before {
        content: ">";
        padding-right: 6px;
        padding-left: 3vw;
    }

    #box{
        border: 6px solid #ffffffab;
        margin: 4vw 4vw;
        border-radius: 20px;
        font-family: nasa;
    }
    </style>
</head>
<body bgcolor="#3C3E42">
    <div id="vanta-bg">
    <center><fieldset id="spacer"><h1 id="heading">'.$NAME_S.'</h1></fieldset></center><br>
    <fieldset id="box"><legend><font id="head">RULES</font></legend>
    <ul>
    <li>NO TEXT TO BE PRINTED WHILE TAKING INPUT(S).</li>
    <li>DO NOT CLOSE BROWSER DURING CONTEST.</li>
    <li>ONLY FIRST THREE SUBMISSIONS WILL BE REWARDED.</li>
    <li>NUMBER OF ATTEMPTS ARE UPDATED IN REAL TIME.</li>
    <li>CARRYING/USE OF ANY ELECTRONIC DEVICE IS PROHIBITED.</li>
    <li>GOOD LUCK!</li>
    </ul>
    </fieldset>
    </div>
    <!-- <script src="style/three.r134.min.js"></script> -->
    <!-- <script src="style/vanta.fog.min.js"></script> -->
    <!-- <script src="style/bg.js"></script> -->
</body>
</html>
    ';
    exit();
}

include '/admin/creds.php';
$conn = new mysqli($host, $user, $passwd, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the query using prepared statements
$auth = "SELECT password, schoolcode FROM users WHERE schoolcode = ?";
$stmt = $conn->prepare($auth);
$stmt->bind_param("s", $schoolcode); // "s" indicates the type of the parameter (string)
$stmt->execute();
$authres = $stmt->get_result();

// Check if there is a matching user
if ($authres->num_rows > 0) {
    // Fetch data from the result set
    $row = $authres->fetch_assoc();
    $password = $row['password'];
    $team = $row['schoolcode'];

    // Verify password
    if ($password === $pass) {
    } else {
        // Passwords do not match, redirect to login page
        echo "Invalid token";
        sleep(5);
        header('Location: login.html');
        exit();
    }
} else {
    // No user found with the provided email
    header('Location: login.html');
    exit();
}

// Close connection
$stmt->close();
$conn->close();
?>

<?php
include '/admin/creds.php';
$conn = new mysqli($host, $user, $passwd, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the query using prepared statements
$auth = "SELECT password, schoolcode FROM users WHERE schoolcode = ?";
$stmt = $conn->prepare($auth);
$stmt->bind_param("s", $schoolcode); // "s" indicates the type of the parameter (string)
$stmt->execute();
$authres = $stmt->get_result();

// Check if there is a matching user
if ($authres->num_rows > 0) {
    // Fetch data from the result set
    $row = $authres->fetch_assoc();
    $password = $row['password'];
    $team = $row['schoolcode'];

    // Verify password
    if ($password === $pass) {
    } else {
        // Passwords do not match, redirect to login page
        echo "Invalid token";
        sleep(5);
        header('Location: login.html');
        exit();
    }
} else {
    // No user found with the provided email
    header('Location: login.html');
    exit();
}

// Close connection
$stmt->close();
$conn->close();
?>

<?php

// Check if /admin/creds.php exists and is readable
if (!file_exists('/admin/creds.php') || !is_readable('/admin/creds.php')) {
    die('Error: /admin/creds.php file is missing or not readable.');
}

// Include the /admin/creds.php file
include '/admin/creds.php';

// Establish database connection
$conn = new mysqli($host, $user, $passwd, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch questions and scores
$query = "SELECT question, score FROM questions";
$r = $conn->query($query);
if ($r === false) {
    die("Query failed: " . $conn->error);
}

$qns = [];
$scores = [];
if ($r->num_rows > 0) {
    while ($row = $r->fetch_assoc()) {
        $qns[] = $row['question'];
        $scores[] = $row['score'];
    }
}

// Close the database connection
$conn->close();

// Display questions and scores
echo '
<!DOCTYPE html>
<title>
'.$NAME.'
</title>
<head>
<link rel="stylesheet" href="style/main.css">
</head>
<body bgcolor="#3C3E42">
<div id="vanta-bg"></div>
<fieldset>
<h1 id="heading">'.$NAME_S.'</h1>
<hr>
<fieldset>
    <h1 id="schoolnamedisplay">Live Scoreboard:</h1>
    <table>
        <thead>
            <tr>
';
$conn = new mysqli($host, $user, $passwd, $db);
$sql = "select id from questions";
$result = $conn->query($sql);
$qno = $result->num_rows;
for ($z = 1; $z <= $qno; $z++) {
    echo '<th id="qtl">Q'.$z.'</th>';
}
$conn->close();
echo '
            </tr>
        </thead>
        <tbody id="scoreboard">
            <tr>
                <td colspan='.($qno+1).'>Loading...</td>
            </tr>
        </tbody>
    </table>
</fieldset>
<br>
<hr>
<br>
<center>
    <fieldset id="errbox">
        Submission status
    </fieldset>
</center>
<br>
<hr>
<br>
';

if(getCommsEn()){
    echo '
<fieldset id="commbox">
    <style>
        textarea{
        width: 100%;
        padding: 8px;
        margin: 10px 0;
        background: rgba(0, 0, 0, 0);
        border: 2px solid #ffffff;
        color: #acffea;
        border-radius: 10px;
        font-family: "nasa", sans-serif;
        font-size: 26px;
        transition: background 0.3s, color 0.3s;
    }
    #replybox,#statusbox{
        border: 6px solid #ffffffab;
        border-radius: 10px;
        padding: 20px;
    }
    </style>
    <form id="helpform" onsubmit="helpFormListener(event)">
    Ask a question:
        <textarea id="questionbox" name="question" rows="4" cols="50"></textarea><br>
        <input type="hidden" name="tcode" value="'.$team.'">
        <input type="submit" value="Send">
    </form>
    <fieldset id="replybox">
    <legend>Reply:</legend>
    <div id="response"></div>
    </fieldset>
    <br>
    <fieldset id="statusbox">
    <legend>Status:</legend>
    <div id="status"></div>
    </fieldset>
</fieldset>
<br>
<hr>
<br>
';
}
foreach ($qns as $index => $question) {
    $questionNumber = $index + 1;
    echo "Q" . $questionNumber . ") " . htmlspecialchars($question) . "<br>";
    echo "Score: " . htmlspecialchars($scores[$index]) . "<br>";
    echo '<p id="q' . $questionNumber . 'attempts"></p>';
    echo '
    <form action="" method="post" enctype="multipart/form-data">
        <div class="file-drop-zone" id="file-drop-zone' . $questionNumber . '"><div id="f' . $questionNumber . '">Click to select a file</div></div>
        <input type="file" id="file' . $questionNumber . '" name="file' . $questionNumber . '" accept=".py,.java" class="file-input">
        <input type="hidden" id="team" name="team" value="' . htmlspecialchars($team) . '">
        <input type="submit" value="Submit">
        <a href="pdfs/' . $questionNumber . '.pdf"><input type="button" value="Info"></a>
        <br><br>
    </form>
    ';
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $max_files = 10; // or any other number greater than 5
    $file_found = false;

    for ($i = 1; $i <= $max_files; $i++) {
        if (isset($_FILES['file' . $i]) && $_FILES['file' . $i]['error'] === UPLOAD_ERR_OK) {
            if (isset($scores[$i - 1])) {
                $qn_score_var = $scores[$i - 1];
                handleFormSubmission($i, $team, $i, $qn_score_var);
                $file_found = true;
                break;
            }
        }
    }

    if (!$file_found) {
        $error_message = "No file was submitted.";
    }
}

function handleFormSubmission($fileInput, $directoryName, $questionId, $qnscore) {
    global $error_message;

    if (!state()) {
        echo "The contest has ended. Please leave.";
        exit();
    }

    global $uploadedFile;
    $uploadedFile = $_FILES["file" . $fileInput];
    $targetDirectory = "uploads/" . $directoryName;
    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }

    $fileExtension = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);
    $newExtension = ($fileExtension === 'py') ? '.py' : (($fileExtension === 'java') ? '.java' : '');
    $targetFilePath = $targetDirectory . "/" . $fileInput . $newExtension;

    if (move_uploaded_file($uploadedFile['tmp_name'], $targetFilePath)) {
        $filename = $targetFilePath;

        $badcode = 0;

        // Fetch test cases from the database
        include '/admin/creds.php';
        $conn = new mysqli($host, $user, $passwd, $db);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $query = "SELECT input, output FROM testcases WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $questionId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Define the descriptors for stdin, stdout, and stderr
        $descriptorspec = [
            0 => ["pipe", "r"], // stdin is a pipe that the child will read from
            1 => ["pipe", "w"], // stdout is a pipe that the child will write to
            2 => ["pipe", "w"]  // stderr is a pipe that the child will write to
        ];

        while ($row = $result->fetch_assoc()) {
            $input = $row['input'];
            $expectedOutput = $row['output'];

            $inputs = explode("^", $input);

            // Run the command for each test case
            if ($newExtension === ".py") {
                $process = proc_open("python3 $filename", $descriptorspec, $pipes);
            } else {
                $process = proc_open("java $filename", $descriptorspec, $pipes);
            }

            if (is_resource($process)) {
                foreach ($inputs as $singleInput) {
                    fwrite($pipes[0], $singleInput . PHP_EOL);
                }
                fclose($pipes[0]);

                $output = stream_get_contents($pipes[1]);
                fclose($pipes[1]);
                $expectedOutput_array = (explode("^",$expectedOutput));
                $output_array = (explode("\n",$output));
                if($output_array[sizeof($output_array)-1] == NULL){
                    array_pop($output_array);
                }

                $errorOutput = stream_get_contents($pipes[2]);
                fclose($pipes[2]);

                $return_value = proc_close($process);
                $compare=array_diff($expectedOutput_array,$output_array);
                if(sizeof($output_array) == sizeof($expectedOutput_array)){
                    if(sizeof($compare) > 0){
                        $badcode = 1;
                        break;
                    }
                } else {
                    $badcode = 1;
                    break;
                }
            } else {
                echo "Could not start the process.<br>";
            }

            if ($badcode === 1) {
                break;
            }
        }

        $stmt->close();
        $conn->close();

        if ($badcode === 0) {
            enterData($directoryName, $fileInput, $qnscore);
        } else {
            $error_message = "Wrong Output on question " . $fileInput . ".";
        }
    } else {
        $error_message = "Please select a file.";
    }
}

function enterData($team, $fileno, $qnscore) {
    global $error_message;
    include '/admin/creds.php';
    $conn = new mysqli($host, $user, $passwd, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the team has already answered this question
    $read = "SELECT `time` FROM submissions WHERE schoolcode = ? AND question = ?";
    $stmt = $conn->prepare($read);
    $stmt->bind_param("si", $team, $fileno);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error_message = "Already answered question " . $fileno . ".";
        $stmt->close();
        $conn->close();
        return;
    }
    $stmt->close();

    // Prepare the query to check other entries for the question
    $entries_read = $conn->prepare("SELECT COUNT(question) as count FROM submissions WHERE question = ?");
    $entries_read->bind_param("i", $fileno);
    $entries_read->execute();
    $result = $entries_read->get_result();
    $row = $result->fetch_assoc();
    $entries = $row['count'];
    $entries_read->close();

    if(getMode()){
        if ($entries === 0) {
            $reward = $qnscore;
        } elseif ($entries === 1) {
            $reward = $qnscore - $qnscore / 4;
        } elseif ($entries === 2) {
            $reward = $qnscore - $qnscore / 2;
        } else {
            $reward = 0;
        }
    } else {
        $reward = $qnscore;
    }

    // Insert the new submission if reward is greater than 0
    if ($reward > 0) {
        $submit = $conn->prepare("INSERT INTO submissions (schoolcode, question, score) VALUES (?, ?, ?)");
        $submit->bind_param("sii", $team, $fileno, $reward);
        if ($submit->execute()) {
            $error_message = "Submission accepted for question " . $fileno . ".";
        } else {
            $error_message = "Error submitting for question " . $fileno . ".";
        }
        $submit->close();
    } elseif ($reward === 0) {
        $error_message = "Submissions have ended for question ".$fileno.".";
        echo"<script>
            function displayerr(){
                const errbox = document.getElementById('errbox');
                var err= '$error_message';
                if(err != ''){
                    errbox.innerHTML = err;
                }
            }
            setTimeout(displayerr(), 100);
            </script>
        ";
    }

    // Close the database connection
    $conn->close();
}
?>
        <script>
            const numQuestions = document.querySelectorAll('input[type="file"]').length;

            function setupFileDropZone(zoneId, inputId, displayId) {
                const zone = document.getElementById(zoneId);
                const input = document.getElementById(inputId);
                const display = document.getElementById(displayId);
                
                zone.addEventListener('click', () => input.click());
                zone.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    zone.classList.add('dragover');
                });
                zone.addEventListener('dragleave', () => {
                    zone.classList.remove('dragover');
                });
                zone.addEventListener('drop', (e) => {
                    e.preventDefault();
                    zone.classList.remove('dragover');
                    input.files = e.dataTransfer.files;
                    displayFileNames(input.files, display);
                });
                input.addEventListener('change', () => {
                    displayFileNames(input.files, display);
                });
            }

            function displayFileNames(files, display) {
                display.innerHTML = '';
                for (const file of files) {
                    const fileName = document.createElement('p');
                    fileName.textContent = file.name;
                    display.appendChild(fileName);
                }
            }
            for (let i = 1; i <= numQuestions; i++) {
                setupFileDropZone('file-drop-zone'+i, 'file'+i,'f'+i);
            }

            function fetchAttempts() {
                // Fetch attempts data from the server
                fetch(`attempts.php?numQuestions=${numQuestions}`)
                    .then(response => response.json())
                    .then(data => {
                        for (let i = 1; i <= numQuestions; i++) {
                            const attemptElement = document.getElementById('q' + i + 'attempts');
                            if (data['qa' + i] !== undefined) {
                                attemptElement.innerHTML = `Attempts: ${data['qa' + i]}`;
                            } else {
                                attemptElement.innerHTML = `Attempts: Loading`;
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching attempt data:', error);
                    });
            }

            // Set up an interval to fetch data every second
            setInterval(fetchAttempts, 1000);

            // Fetch attempts immediately on page load
            fetchAttempts();
            function fetchScoreboard() {
                fetch(`score.php`)
                    .then(response => response.json())
                    .then(data => {
                        const scoreboard = document.getElementById('scoreboard');
                        const schoolnamedisplay = document.getElementById('schoolnamedisplay');
                        const numQuestions = document.querySelectorAll('input[type="file"]').length;

                        if (data.error) {
                            scoreboard.innerHTML = `<tr><td colspan="${numQuestions + 1}">No submissions from your school yet.</td></tr>`;
                            schoolnamedisplay.innerHTML = `<td>Live scoreboard</td>`;
                        } else {
                            schoolnamedisplay.innerHTML = `<td>${data.schoolcode}</td>`;

                            let rows = '<tr>';
                            for (let i = 1; i <= numQuestions; i++) {
                                rows += `<td>${data['q' + i] || 'Not attempted'}</td>`;
                            }
                            rows += '</tr>';
                            scoreboard.innerHTML = rows;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching score data:', error);
                    });
            }
            setInterval(fetchScoreboard, 1000);
            fetchScoreboard();
        </script>
        <script>
            function displayerr(){
                const errbox = document.getElementById('errbox');
                var err= "<?php echo $error_message; ?>";
                if(err != ""){
                    errbox.innerHTML = err;
                }
            }
            setTimeout(displayerr(), 100);
        </script>
        <!-- <script src="style/three.r134.min.js"></script>
        <script src="style/vanta.fog.min.js"></script>
        <script src="style/bg.js"></script> -->
        <script>
            function helpFormListener(){
                event.preventDefault(); // Prevent form from submitting the traditional way
                const formData = new FormData(document.getElementById("helpform"));
                const qbox = document.getElementById("questionbox");
                fetch('helpformsubmit.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('status').innerHTML = data;
                    qbox.value = '';
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        </script>
        <script>
            let prevdata = '';
            function fetchResponse() {
                    fetch('receive.php')
                        .then(response => response.json())
                        .then(data => {
                            if(data.reply == null){}
                            if(data.reply == 'Hello'){}
                            console.log("data:"+data.reply);
                            console.log("prevdata:"+prevdata);
                            if (data.reply != prevdata){
                                console.log('unequal');
                                document.getElementById('response').innerText = data.reply;
                            }
                            prevdata = data.reply;
                        });
        }
            fetchResponse();
            setInterval(fetchResponse, 1000);
        </script>
    </body>
</html>
